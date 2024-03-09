<div>
    <input type="text" id="question" wire:model="question">
    <button wire:click="predict">ASK GPT</button>
    <h4>{{ $answer }}</h4>
</div>
