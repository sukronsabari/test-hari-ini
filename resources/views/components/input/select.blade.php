@props([
    "options" => [],
])

<select {{ $attributes->merge(["class" => "bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5"]) }}>
    @foreach ($options as $opt)
        <option class="hover:bg-green-400" value="{{ $opt['value'] }}" @selected($opt['selected'])>{{ $opt['label'] }}</option>
    @endforeach
</select>

