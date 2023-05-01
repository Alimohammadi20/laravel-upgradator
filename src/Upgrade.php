<?php

namespace SystemUpdator;

abstract class Upgrade
{
    protected string $description;
    protected string $date;
    protected string $version;

    abstract public function up();

    abstract public function down();

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDate(): string
    {
        return $this->date;
    }
}
