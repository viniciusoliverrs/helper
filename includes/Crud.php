<?php
interface Crud
{
    public function add(): bool;
    public function getALl(): array;
    public function get($id): array;
    public function delete($id): bool;
    //public function edit($id): bool;
}
