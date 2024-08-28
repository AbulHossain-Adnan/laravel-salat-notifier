<?php 

namespace welabs\SalatNotifier\Contracts;

interface SalatTimeInterface
{
    public function getAllSalatTimes();
    public function getSalatTimeById($id);
    public function createSalatTime(array $data);
    public function updateSalatTime($id, array $data);
    public function deleteSalatTime($id);
}
