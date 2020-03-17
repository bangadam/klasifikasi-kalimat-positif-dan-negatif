<?php

class Klasifikasi
{
    private $types     = [Tipe::POSITIF, Tipe::NEGATIF];
    private $words     = [Tipe::POSITIF => [], Tipe::NEGATIF => []];
    private $documents = [Tipe::POSITIF => 0, Tipe::NEGATIF => 0];

    public function guess($statement)
    {
        $words           = $this->getWords($statement);
        $best_likelihood = 0;
        $best_type       = null;

        foreach ($this->types as $type) {
            $likelihood = $this->pTotal($type);

            foreach ($words as $word) {
                $likelihood *= $this->p($word, $type);
            }

            if ($likelihood > $best_likelihood) {
                $best_likelihood = $likelihood;
                $best_type       = $type;
            }
        }

        return $best_type;
    }

    public function learn($statement, $type)
    {
        $words = $this->getWords($statement);

        foreach ($words as $word) {
            if (!isset($this->words[$type][$word])) {
                $this->words[$type][$word] = 0;
            }
            $this->words[$type][$word]++;
        }
        $this->documents[$type]++;
    }

    public function p($word, $type)
    {
        $count = 0;

        if (isset($this->words[$type][$word])) {
            $count = $this->words[$type][$word];
        }

        return ($count + 1) / (array_sum($this->words[$type]) + 1);
    }

    public function pTotal($type)
    {
        return ($this->documents[$type] + 1) / (array_sum($this->documents) + 1);
    }

    public function getWords($string)
    {
        return preg_split('/\s+/', preg_replace('/[^A-Za-z0-9\s]/', '', strtolower($string)));
    }
}
