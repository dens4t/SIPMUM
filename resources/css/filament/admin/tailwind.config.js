import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                'blue-gradient-start': '#035193', // Light blue
                'blue-gradient-end': '#62b6e4',   // Dark blue
            },
        },
    },
}
