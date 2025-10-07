<?php

if (!function_exists('generar_avatar')) {
    /**
     * Genera URL de avatar usando UI Avatars
     * 
     * @param string $nombre
     * @param string $apellido
     * @param int $size Tamaño del avatar en píxeles
     * @param string $background Color de fondo (hex sin #)
     * @param string $color Color del texto (hex sin #)
     * @return string URL del avatar
     */
    function generar_avatar($nombre, $apellido, $size = 120, $background = '0d6efd', $color = 'ffffff')
    {
        $nombreCompleto = trim($nombre . ' ' . $apellido);
        
        // Parámetros para UI Avatars
        $params = [
            'name' => $nombreCompleto,
            'size' => $size,
            'background' => $background,
            'color' => $color,
            'bold' => 'true',
            'format' => 'png'
        ];
        
        return 'https://ui-avatars.com/api/?' . http_build_query($params);
    }
}

if (!function_exists('generar_avatar_fallback')) {
    /**
     * Genera URL de avatar de respaldo usando Placeholder.com
     * 
     * @param string $nombre
     * @param string $apellido
     * @param int $size
     * @param string $background
     * @param string $color
     * @return string URL del avatar de respaldo
     */
    function generar_avatar_fallback($nombre, $apellido, $size = 120, $background = '0d6efd', $color = 'ffffff')
    {
        $iniciales = strtoupper(substr($nombre, 0, 1) . substr($apellido, 0, 1));
        return "https://via.placeholder.com/{$size}x{$size}/{$background}/{$color}?text={$iniciales}";
    }
}

if (!function_exists('avatar_completo')) {
    /**
     * Genera HTML completo del avatar con fallback
     * 
     * @param string $nombre
     * @param string $apellido
     * @param int $size
     * @param string $clases CSS adicionales
     * @return string HTML del avatar
     */
    function avatar_completo($nombre, $apellido, $size = 120, $clases = 'rounded-circle')
    {
        $avatarUrl = generar_avatar($nombre, $apellido, $size);
        $fallbackUrl = generar_avatar_fallback($nombre, $apellido, $size);
        $nombreCompleto = esc($nombre . ' ' . $apellido);
        
        return "<img src=\"{$avatarUrl}\" 
                     alt=\"Avatar de {$nombreCompleto}\" 
                     class=\"{$clases}\"
                     style=\"width: {$size}px; height: {$size}px; object-fit: cover;\"
                     onerror=\"this.src='{$fallbackUrl}'\">";
    }
}
