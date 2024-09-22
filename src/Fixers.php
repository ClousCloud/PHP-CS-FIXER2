<?php

namespace phpcodestyle\fixers;

interface FixerInterface
{
    /**
     * Method ini harus diimplementasikan oleh setiap fixer untuk memperbaiki konten.
     *
     * @param string $content
     * @return string
     */
    public function fix(string $content): string;

    /**
     * Memberikan deskripsi singkat tentang apa yang dilakukan oleh fixer.
     *
     * @return string
     */
    public function getDescription(): string;
}
