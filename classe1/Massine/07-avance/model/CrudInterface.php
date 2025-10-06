<?php
// création du namespace
namespace model;

// interface non obligatoire, uniquement en cas de CRUD
interface CrudInterface
{
    // on utilise pour insérer l'AbstractMapping, car il sera le parent de tous les enfants qui pourront utiliser le CRUD (mapping des tables de la DB).
    public function create(AbstractMapping $data);
    public function readById(int $id): bool|AbstractMapping;
    public function readAll(bool $orderDesc=true): array;
    public function update(int $id, AbstractMapping $data);
    public function delete(int $id);
}