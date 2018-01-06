<?php

namespace Backpack\CRUD\PanelTraits;

trait AutoSet
{
    // ------------------------------------------------------
    // AUTO-SET-FIELDS-AND-COLUMNS FUNCTIONALITY
    // ------------------------------------------------------

    /**
     * For a simple CRUD Panel, there should be no need to add/define the fields.
     * The public columns in the database will be converted to be fields.
     */
    public function setFromDb()
    {
        $this->setDoctrineTypesMapping();
        $this->getDbColumnTypes();

        array_map(function($field) {
            // $this->labels[$field] = $this->makeLabel($field);
            $type = $this->getFieldTypeFromDbColumnType($field) === 'boolean' ? 'checkbox' : $this->getFieldTypeFromDbColumnType($field);
            $default = isset($this->db_column_types[ $field ]['default']) ? $this->db_column_types[ $field ]['default'] : null;
            $new_field = [
                'name'       => $field,
                'label'      => $this->makeLabel($field),
                'value'      => null,
                'default'    => $default,
                'type'       => $type,
                'values'     => [],
                'attributes' => [],
                'autoset'    => true,
            ];
            if ( ! isset($this->create_fields[ $field ])) {
                $this->create_fields[ $field ] = $new_field;
            }
            if ( ! isset($this->update_fields[ $field ])) {
                $this->update_fields[ $field ] = $new_field;
            }
        }, $this->getDbColumnsNames());

        $columns = config('backpack.crud.exclude_metadata_columns', true) ?
            array_diff($this->getAllDbColumnsNames(), $this->getMetaColumns()) :
            $this->getAllDbColumnsNames();
        array_map(function($field) {
            if ( ! isset($this->columns[ $field ]) && ! \in_array($field, $this->model->getHidden(), true)) {
                //we don't have a distinct column type for numbers
                $type = $this->getFieldTypeFromDbColumnType($field) !== 'number' ? $this->getFieldTypeFromDbColumnType($field) : 'text';
                $this->addColumn([
                    'name'    => $field,
                    'label'   => $this->makeLabel($field),
                    'type'    => $type,
                    'autoset' => true,
                ]);
            }
        }, $columns);
    }

    /**
     * Get all columns from the database for that table.
     *
     * @return array
     */
    public function getDbColumnTypes()
    {
        if (empty($this->db_column_types)) {
            $table_columns = $this->getDbColumns();

            foreach ($table_columns as $key => $column) {
                $column_type = $column->getType()->getName();

                $this->db_column_types[ $column->getName() ]['type']    = trim(preg_replace('/\(\d+\)(.*)/i', '', $column_type));
                $this->db_column_types[ $column->getName() ]['default'] = $column->getDefault();
            }
        }

        return $this->db_column_types;
    }

    /**
     * Intuit a field type, judging from the database column type.
     *
     * @param  [string] Field name.
     *
     * @return string Field type.
     */
    public function getFieldTypeFromDbColumnType($field)
    {
        if ( ! array_key_exists($field, $this->db_column_types)) {
            return 'text';
        }

        if ($field === 'password') {
            return 'password';
        }

        if ($field === 'email') {
            return 'email';
        }

        switch ($this->db_column_types[ $field ]['type']) {
            case 'decimal':
            case 'float':
            case 'int':
            case 'integer':
            case 'mediumint':
            case 'longint':
            case 'smallint':
                return 'number';
                break;

            case 'string':
            case 'varchar':
            case 'set':
                return 'text';
                break;

            // case 'enum':
            //     return 'enum';
            // break;

            case 'boolean':
            case 'tinyint':
                return 'boolean';
                break;

            case 'text':
                return 'textarea';
                break;

            case 'mediumtext':
            case 'longtext':
                return 'textarea';
                break;

            case 'date':
                return 'date';
                break;

            case 'datetime':
            case 'timestamp':
                return 'datetime';
                break;
            case 'time':
                return 'time';
                break;

            default:
                return 'text';
                break;
        }
    }

    // Fix for DBAL not supporting enum
    public function setDoctrineTypesMapping()
    {
        $types    = [ 'enum' => 'string' ];
        $platform = \DB::getDoctrineConnection()->getDatabasePlatform();
        foreach ($types as $type_key => $type_value) {
            if ( ! $platform->hasDoctrineTypeMappingFor($type_key)) {
                $platform->registerDoctrineTypeMapping($type_key, $type_value);
            }
        }
    }

    /**
     * Turn a database column name or PHP variable into a pretty label to be shown to the user.
     * Converts CamelCase variables to underscore and then converts underscores to spaces
     *
     * @param  string $value
     *
     * @return string
     */
    public function makeLabel($value)
    {
        if (strtolower($value) === 'id') {
            return 'Id';
        };
        return title_case(trim(preg_replace('/(id|at|\[\])$/i', '', str_replace('_', ' ', $this->CamelCaseToSeparator($value)))));
    }

    /**
     * Converts CamelCase string to underscore
     * https://stackoverflow.com/a/33606137/634129
     *
     * @param        $value
     * @param string $separator
     *
     * @return string
     */
    private function CamelCaseToSeparator($value, $separator = '_')
    {
        if ( ! is_scalar($value) && ! is_array($value)) {
            return $value;
        }
        if (\defined('PREG_BAD_UTF8_OFFSET_ERROR') && preg_match('/\pL/u', 'a') == 1) {
            $pattern     = [ '#(?<=(?:\p{Lu}))(\p{Lu}\p{Ll})#', '#(?<=(?:\p{Ll}|\p{Nd}))(\p{Lu})#' ];
            $replacement = [ $separator . '\1', $separator . '\1' ];
        } else {
            $pattern     = [ '#(?<=(?:[A-Z]))([A-Z]+)([A-Z][a-z])#', '#(?<=(?:[a-z0-9]))([A-Z])#' ];
            $replacement = [ '\1' . $separator . '\2', $separator . '\1' ];
        }

        return preg_replace($pattern, $replacement, $value);
    }

    public function getAllDbColumnsNames()
    {
        if (empty($this->db_all_column_names)) {
            $this->db_all_column_names = array_keys($this->getDbColumnTypes());
        }

        return $this->db_all_column_names;
    }

    /**
     * Get the database column names, in order to figure out what fields/columns to show in the auto-fields-and-columns functionality.
     *
     * @return array Database column names as an array.
     */
    public function getDbColumnsNames()
    {
        //build the db_column_names array only once
        if (empty($this->db_column_names)) {
            // Automatically-set columns should be both in the database, and in the $fillable variable on the Eloquent Model
            $this->db_column_names = $this->getAllDbColumnsNames();

            $columns  = $this->db_column_names;
            $fillable = $this->model->getFillable();
            if ( ! empty($fillable)) {
                $columns = array_intersect($columns, $fillable);
            }// but not key, created_at, updated_at, deleted_at
            $this->db_column_names = array_values(array_diff($columns, $this->getMetaColumns()));
        }

        return $this->db_column_names;
    }

    /**
     * Create an array of metadata column names to be excluded from columns/fields
     * @return array
     */
    private function getMetaColumns()
    {
        return [
            $this->model->getKeyName(),
            method_exists($this->model, 'getCreatedAtColumn') ? $this->model->getCreatedAtColumn() : null,
            method_exists($this->model, 'getUpdatedAtColumn') ? $this->model->getUpdatedAtColumn() : null,
            method_exists($this->model, 'getDeletedAtColumn') ? $this->model->getDeletedAtColumn() : null,
        ];
    }
}
