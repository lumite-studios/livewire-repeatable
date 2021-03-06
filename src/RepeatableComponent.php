<?php
namespace LumiteStudios\LivewireRepeatable;

use Livewire\Component;

/**
 * Class RepeatableComponent
 * @package LumiteStudios\LivewireRepeatable
 *
 * @property array $items
 * @property string $view
 * @property string $theme
 * @property string $addButtonClasses
 * @property string $addButtonContainerClasses
 * @property string $noItemsClasses
 * @property string $noItemsText
 * @property string $removeButtonClasses
 * @property string $itemContainerClasses
 * @property string $moveButtonContainerClasses
 * @property string $moveUpButtonClasses
 * @property string $moveDownButtonClasses
 */
class RepeatableComponent extends Component
{
	public array $items = [];
	public string $view;

	public string $theme;
	public string $addButtonClasses;
	public string $addButtonContainerClasses;
	public string $noItemsClasses;
	public string $noItemsText;
	public string $removeButtonClasses;
	public string $itemContainerClasses;
	public string $moveButtonContainerClasses;
	public string $moveUpButtonClasses;
	public string $moveDownButtonClasses;

	/**
	 * Mount the livewire component.
	 *
	 * @return void
	 */
    public function mount(string $view,
						  array $items = [],
						  string $theme = '',
						  string $addButtonClasses = '',
						  string $addButtonContainerClasses = '',
						  string $noItemsClasses = '',
						  string $noItemsText = 'There are no items to display.',
						  string $removeButtonClasses = '',
						  string $itemContainerClasses = '',
						  string $moveButtonContainerClasses = '',
						  string $moveUpButtonClasses = '',
						  string $moveDownButtonClasses = '')
    {
        $this->view = $view;

        $this->items = collect($items)->map(function($item, $key) {
			$item['id'] = array_key_exists('id', $item) ? $item['id'] : 'item-'.$key;
			return $item;
		})->toArray();

        $this->theme = in_array($theme, $this->getThemes()) ? $theme : '';
        $this->addButtonClasses = $addButtonClasses;
        $this->addButtonContainerClasses = $addButtonContainerClasses;
        $this->noItemsClasses = $noItemsClasses;
        $this->noItemsText = $noItemsText;
        $this->removeButtonClasses = $removeButtonClasses;
        $this->itemContainerClasses = $itemContainerClasses;
        $this->moveButtonContainerClasses = $moveButtonContainerClasses;
        $this->moveUpButtonClasses = $moveUpButtonClasses;
        $this->moveDownButtonClasses = $moveDownButtonClasses;
    }

	/**
	 * Render the livewire component.
	 *
	 * @return \Illuminate\View\View
	 */
	public function render()
	{
        return view('livewire-repeatable::repeatable');
	}

	/**
	 * Add an item.
	 *
	 * @return void
	 */
	public function addItem()
	{
		$this->items[] = ['id' => 'item-'.count($this->items)];
	}

	/**
	 * Remove an item.
	 *
	 * @param int $index
	 * @return void
	 */
	public function removeItem(int $index)
	{
		unset($this->items[$index]);
	}

	/**
	 * Move an item up one.
	 *
	 * @param int $index
	 * @return void
	 */
	public function moveUp(int $index)
	{
		$this->moveElement($index, $index-1);
	}

	/**
	 * Move an item down one.
	 *
	 * @param int $index
	 * @return void
	 */
	public function moveDown(int $index)
	{
		$this->moveElement($index, $index+1);
	}

	/**
	 * Get the add button container class.
	 *
	 * @return string
	 */
	public function getAddButtonContainerClassProperty(): string
	{
		switch($this->theme) {
			case 'tailwind': {
				return 'text-right';
				break;
			}
			default: {
				return $this->addButtonContainerClasses;
			}
		}
	}

	/**
	 * Get the add button class.
	 *
	 * @return string
	 */
	public function getAddButtonClassProperty(): string
	{
		switch($this->theme) {
			case 'tailwind': {
				return 'bg-blue-600 p-1 rounded text-white';
				break;
			}
			default: {
				return $this->addButtonClasses;
			}
		}
	}

	/**
	 * Get the no items class.
	 *
	 * @return string
	 */
	public function getNoItemsClassProperty(): string
	{
		switch($this->theme) {
			case 'tailwind': {
				return 'text-center dark:text-gray-500';
				break;
			}
			default: {
				return $this->noItemsClasses;
			}
		}
	}

	/**
	 * Get the item container class.
	 *
	 * @return string
	 */
	public function getItemContainerClassProperty(): string
	{
		switch($this->theme) {
			case 'tailwind': {
				return 'flex items-center mb-2 space-x-4';
				break;
			}
			default: {
				return $this->itemContainerClasses;
			}
		}
	}

	/**
	 * Get the remove button class.
	 *
	 * @return string
	 */
	public function getRemoveButtonClassProperty(): string
	{
		switch($this->theme) {
			case 'tailwind': {
				return 'bg-red-600 p-1 rounded';
				break;
			}
			default: {
				return $this->removeButtonClasses;
			}
		}
	}

	/**
	 * Get the move button container class.
	 *
	 * @return string
	 */
	public function getMoveButtonContainerClassProperty(): string
	{
		switch($this->theme) {
			case 'tailwind': {
				return 'flex flex-col';
				break;
			}
			default: {
				return $this->moveButtonContainerClasses;
			}
		}
	}

	/**
	 * Get the move up button class.
	 *
	 * @return string
	 */
	public function getMoveUpButtonClassProperty(): string
	{
		switch($this->theme) {
			case 'tailwind': {
				return 'bg-blue-600 p-1 rounded rounded-b-none';
				break;
			}
			default: {
				return $this->moveUpButtonClasses;
			}
		}
	}

	/**
	 * Get the move down button class.
	 *
	 * @return string
	 */
	public function getMoveDownButtonClassProperty(): string
	{
		switch($this->theme) {
			case 'tailwind': {
				return 'bg-blue-600 p-1 rounded rounded-t-none';
				break;
			}
			default: {
				return $this->moveDownButtonClasses;
			}
		}
	}

	/**
	 * Move an element.
	 *
	 * @param int $start
	 * @param int $end
	 * @return void
	 */
	private function moveElement(int $start, int $end) {
		$out = array_splice($this->items, $start, 1);
		array_splice($this->items, $end, 0, $out);
	}

	/**
	 * The available themes.
	 *
	 * @return array
	 */
	private function getThemes(): array
	{
		return ['tailwind'];
	}
}
