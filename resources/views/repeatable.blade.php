<div>
	<div class="{{ $this->addButtonContainerClass }}">
		<button wire:click.prevent="addItem()" class="{{ $this->addButtonClass }}">
			<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
			</svg>
		</button>
	</div>

	@if(count($items) === 0)
		<div class="{{ $this->noItemsClass }}">
			{{ $noItemsText }}
		</div>
	@else
		@foreach($items as $index => $item)
			<div class="{{ $this->itemContainerClass }}">
				<!-- remove item -->
				<button class="{{ $this->removeButtonClass }}" wire:click.prevent="removeItem({{ $index }})">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
					</svg>
				</button>

				<!-- item -->
				<livewire:repeatable-view-component :data="$item" :index="$index" :view="$view" :wire:key="$item['id']" />

				<!-- move item -->
				<div class="{{ $this->moveButtonContainerClass }}">
					<button class="{{ $this->moveUpButtonClass }}" wire:click.prevent="moveUp({{ $index }})">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
						</svg>
					</button>
					<button class="{{ $this->moveDownButtonClass }}" wire:click.prevent="moveDown({{ $index }})">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
						</svg>
					</button>
				</div>
			</div>
		@endforeach
	@endif
</div>
