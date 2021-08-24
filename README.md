# lumite-studios/livewire-repeatable

![PHP ^8.0](https://img.shields.io/badge/PHP-%5E8.0-787CB5?style=for-the-badge&logo=php)
![Laravel ^8.52](https://img.shields.io/badge/Laravel-%5E8.52-fb503b?style=for-the-badge&logo=laravel)

## Installation
`composer require lumite-studios/livewire-repeatable`

## Usage
The "Repeatable Component" requires a view path to be passed as a property. You can optionally pass existing items as an array and a theme (or you can style it with your own classes.).

`form.blade.php`
```html
<livewire:repeatable-component
	:items="$items ?? [['input' => 'test']]"
	theme="tailwind"
	view="repeating-view"
/>
```

Within the repeating view an index and a data property will be available. The index can be used for any input names, and the data property will contain any data passed through the items property.

`repeating-view.blade.php`
```html
<div class="flex-grow">
	<label for="fields[{{ $index }}][input]">Input</label>
	<input name="fields[{{ $index }}][input]" type="text" :value="$data['input'] ?? null">
</div>
```
