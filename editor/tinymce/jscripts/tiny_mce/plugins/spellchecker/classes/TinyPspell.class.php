<?php

/* *
 * Tiny Spelling Interface for TinyMCE Spell Checking.
 *
 * Copyright © 2006 Moxiecode Systems AB
 *
 */

class TinyPSpell
{
    public $lang;
    public $mode;
    public $string;
    public $plink;
    public $errorMsg;

    public $jargon;
    public $spelling;
    public $encoding;

    public function __construct(&$config, $lang, $mode, $spelling, $jargon, $encoding)
    {
        $this->lang     = $lang;
        $this->mode     = $mode;
        $this->plink    = false;
        $this->errorMsg = array();

        if (!function_exists('pspell_new')) {
            $this->errorMsg[] = 'PSpell not found.';

            return;
        }

        $this->plink = pspell_new($this->lang, $this->spelling, $this->jargon, $this->encoding, $this->mode);
    }

    // Returns array with bad words or false if failed.
    public function checkWords($wordArray)
    {
        if (!$this->plink) {
            $this->errorMsg[] = 'No PSpell link found for checkWords.';

            return array();
        }

        $wordError = array();
        foreach ($wordArray as $word) {
            if (!pspell_check($this->plink, trim($word))) {
                $wordError[] = $word;
            }
        }

        return $wordError;
    }

    // Returns array with suggestions or false if failed.
    public function getSuggestion($word)
    {
        if (!$this->plink) {
            $this->errorMsg[] = 'No PSpell link found for getSuggestion.';

            return array();
        }

        return pspell_suggest($this->plink, $word);
    }
}

// Setup classname, should be the same as the name of the spellchecker class
$spellCheckerConfig['class'] = 'TinyPspell';
