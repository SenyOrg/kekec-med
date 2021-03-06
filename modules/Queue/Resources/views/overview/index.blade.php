@extends('theme::hero')

@section('content')
<template id="event-queue">
    <div id="event-queue">
        <h1>Event-Queue</h1>
        <template v-for="item in events">
            <event-item v-bind:item="item"></event-item>
        </template>
    </div>
</template>
<template id="event-item">
    <div>
        <span>!! item.title !!</span>
        <button v-on:click="delete">Delete</button>
        <button v-on:click="moveToIngoing">Move to Ingoing</button>
    </div>
</template>

<template id="single-queue">
    <div id="queue-!! queue.id !!">
        <h1>!! queue.title !!</h1>
        <template v-for="item in items | filterBy queueFilter">
            <queue-item v-bind:item="item"></queue-item>
        </template>
    </div>
</template>
<template id="multiple-queue">
    <div id="queue-!! queue.id !!">
        <h1>!! queue.title !!</h1>
        <template v-for="item in items | filterBy queueFilter">
            <queue-item v-bind:item="item"></queue-item>
        </template>
    </div>
</template>
<template id="ingoing-queue">
    <div id="queue-!! queue.id !!">
        <h1>!! queue.title !!</h1>
        <template v-for="item in items | filterBy queueFilter">
            <queue-item v-bind:item="item" ingoing=true></queue-item>
        </template>
    </div>
</template>
<template id="outgoing-queue">
    <div id="queue-!! queue.id !!">
        <h1>!! queue.title !!</h1>
        <template v-for="item in items | filterBy queueFilter">
            <queue-item v-bind:item="item"></queue-item>
        </template>
    </div>
</template>
<template id="queue-item">
    <div>
        <span>!! item.patient.firstname !! !! item.patient.lastname !!</span>
        <template v-if=ingoing>
            <button v-on:click="delete">Delete</button>
            <button v-on:click="moveToQueue">Move to Queue</button>
            <select v-model="selectedQueue">
                <option v-for="option in $root.queues" v-bind:value="option.id">
                    !! option.title !!
                </option>
            </select>
        </template>
    </div>
</template>


<div id="queue-app">
    <event-queue v-bind:events="events"></event-queue>
    <ingoing-queue v-ref:ingoing v-bind:queue="ingoingQueue" v-bind:items="items"></ingoing-queue>
    <outgoing-queue v-ref:outgoing v-bind:queue="outgoingQueue" v-bind:items="items"></outgoing-queue>
    <template v-for="queue in queues">
        <template v-if="queue.multiple">
            <multiple-queue v-bind:queue="queue" v-bind:items="items"></multiple-queue>
        </template>
        <template v-else>
            <single-queue v-bind:queue="queue" v-bind:items="items"></single-queue>
        </template>
    </template>
</div>
@endsection

@section('end-content')
<script type="text/javascript">
    dataStore = {
        ingoingQueue: {!! \KekecMed\Queue\Entities\Queue::where('title', 'Ingoing')->get()->first()->toJson() !!},
        outgoingQueue: {!! \KekecMed\Queue\Entities\Queue::where('title', 'Outgoing')->get()->first()->toJson() !!},
        queues: {!! $queues->toJson() !!},
        events: {!! $events->toJson() !!},
        items: {!! \KekecMed\Queue\Entities\QueueItem::with('patient')->get()->toJson() !!}
    };
</script>
<script type="text/javascript" src="{{asset('modules/queue/app.js')}}"></script>
@endsection