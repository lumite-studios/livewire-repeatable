<?php
namespace LumiteStudios\LivewireRepeatable;

use Livewire\Component;

/**
 * Class RepeatableViewComponent
 * @package LumiteStudios\LivewireRepeatable
 *
 * @property array $data
 * @property int $index
 * @property string $view
 */
class RepeatableViewComponent extends Component
{
	public array $data;
	public int $index;
	public string $view;

	/**
	 * Mount the livewire component.
	 *
	 * @param string $view
	 * @param array $data
	 * @param int $index
	 * @return void
	 */
    public function mount(string $view, array $data = [], int $index = 0)
    {
        $this->index = $index;
        $this->data = $data;
        $this->view = $view;
    }

	/**
	 * Render the livewire component.
	 *
	 * @return \Illuminate\View\View
	 */
	public function render(): \Illuminate\View\View
	{
        return view($this->view);
	}
}
