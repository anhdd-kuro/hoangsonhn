<div x-data="{
   count: 0,
   increment() { this.count++ },
   decrement() { this.count-- },
}">
   <h2 x-text="count"></h2>
   <button @click="increment">Increment</button>
   <button @click="decrement">Decrement</button>
</div>