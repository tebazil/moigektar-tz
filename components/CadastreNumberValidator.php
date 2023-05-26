<?php


namespace app\components;


class CadastreNumberValidator
{
    public function isValid(string $cadastreNumber)
    {
        $arr = [];
        preg_match('/\d{2}:\d{2}:\d{6,7}:\d+/', $cadastreNumber, $arr);
        return isset($arr[0]);
    }

    /**
     * @param array $cadastreNumbers
     * @throws \Exception
     */
    public function ensureNumbersAreValid(array $cadastreNumbers)
    {
        array_walk($cadastreNumbers, 'trim');
        foreach($cadastreNumbers as $cadastreNumber) {
            if(!$this->isValid($cadastreNumber)) {
                throw new \Exception("Cadastre number ".$cadastreNumber." is not valid");
            }
        }
    }
}