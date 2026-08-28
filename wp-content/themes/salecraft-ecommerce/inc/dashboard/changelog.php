<?php
/**
 * SaleCraft Ecommerce Changelog.
 *
 * @package SaleCraft Ecommerce
 * @since   1.0.0
 */

defined('ABSPATH') || exit;

class SaleCraft_Ecommerce_Changelog_Parser {

    public function get_items() {
        return $this->parse_changelog($this->read_changelog());
    }

    protected function read_changelog() {
        global $wp_filesystem;

        if (!$wp_filesystem || 'direct' !== $wp_filesystem->method) {
            require_once ABSPATH . '/wp-admin/includes/file.php';
            WP_Filesystem(request_filesystem_credentials('', 'direct'));
        }

        $salecraft_ecommerce_file = get_template_directory() . '/readme.txt';

        if (!$wp_filesystem || !$wp_filesystem->exists($salecraft_ecommerce_file)) {
            return new WP_Error('changelog_not_found', 'Changelog not found.');
        }

        return $wp_filesystem->get_contents($salecraft_ecommerce_file);
    }

    protected function parse_changelog($salecraft_ecommerce_content) {
        if (is_wp_error($salecraft_ecommerce_content)) return $salecraft_ecommerce_content;

        $salecraft_ecommerce_entries = preg_split('/(?==\s\d+\.\d+\.\d+)/', $salecraft_ecommerce_content, -1, PREG_SPLIT_NO_EMPTY);
        $salecraft_ecommerce_output  = [];

        foreach ($salecraft_ecommerce_entries as $entry) {

            if (!preg_match('/= (\d+(?:\.\d+)*) - (\d{4}-\d{2}-\d{2}) =/', $entry, $m)) continue;

            $version = $m[1];
            $date    = $m[2];
            $changes = [];

            if (preg_match_all('/^\* (.+)$/m', $entry, $lines)) {
                foreach ($lines[1] as $line) {

                    $parts = explode(' - ', $line, 2);
                    $tag   = count($parts) === 2 ? trim($parts[0]) : 'update';
                    $desc  = count($parts) === 2 ? trim($parts[1]) : trim($line);

                    $changes[$tag][] = rtrim($desc, '. ');
                }
            }

            if ($changes) {
                $salecraft_ecommerce_output[] = compact('version', 'date', 'changes');
            }
        }

        return $salecraft_ecommerce_output;
    }
}