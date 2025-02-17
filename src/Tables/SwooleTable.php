<?php

namespace Laravel\Octane\Tables;

use Swoole\Table;

class SwooleTable extends Table
{
    use Concerns\EnsuresColumnSizes;

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns;

    /**
     * Set the data type and size of the columns.
     *
     * @param  string  $name
     * @param  int  $type
     * @param  int  $size
     * @return void
     */
    public function column(string $name, string $type, int $size = 0)
    {
        $this->columns[$name] = [$type, $size];

        parent::column($name, $type, $size);
    }

    /**
     * Update a row of the table.
     *
     * @param  string  $key
     * @param  array  $values
     * @return void
     */
    public function set($key, array $values)
    {
        collect($values)
            ->each($this->ensureColumnsSize());

        parent::set($key, $values);
    }
}
