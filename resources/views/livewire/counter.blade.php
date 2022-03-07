<div style="text-align: center">
    {{--the click event triggers a function--}}
    <button wire:click="increment">+</button>
    <h1>{{$count}}</h1>
    <button wire:click="decrement">-</button>
</div>
