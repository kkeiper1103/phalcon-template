<?php

namespace App\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\ModelInterface;

abstract class BaseModel extends Model
{
    protected array $fillable = [];

    public function getFillable(): array { return $this->fillable; }

    protected ?array $columnMap = null;
    public function getColumnMap(): ?array { return $this->columnMap; }


    public function assign(array $data, $whiteList = null, $dataColumnMap = null): ModelInterface
    {
        throw new \Exception("Model::assign is inaccessible. Use Model::fill instead. This enforces field whitelisting.");
    }

    public function fill(array $data): ModelInterface {
        return parent::assign($data, $this->getFillable(), $this->getColumnMap());
    }
}