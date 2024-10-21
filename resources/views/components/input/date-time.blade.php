<input {{ $attributes->merge(['class' => "shadow-sm bg-gray-50 border border-gray-300 text-gray-800 sm:text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5"]) }}
    x-data
    x-init="flatpickr($el, {
        enableTime: true,
        dateFormat: 'Y-m-d H:i',
    });"
/>
