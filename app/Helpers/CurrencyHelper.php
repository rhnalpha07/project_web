<?php

if (!function_exists('format_rupiah')) {
    /**
     * Format a number as Indonesian Rupiah
     *
     * @param float $amount
     * @return string
     */
    function format_rupiah($amount)
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
} 