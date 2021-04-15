<script>
    import workingDay from "../../FunctionalComponents/working-day-store";

    export let timeSlot;
    export let v;
    let active;
    let selectedDay;

    const unsubscribe = workingDay.subscribe((_workingDay) => {
        selectedDay = _workingDay;
    });

    $: active = timeSlot.avaiable;
</script>

{#if timeSlot.minute === 0}
    <button
        class={active ? "active " + "timeSlot" : "notActive " + "timeSlot"}
        on:click={() => {
            workingDay.changeTimeHour(v, selectedDay);
        }}
        >{timeSlot.hour === 0 ? "00" : timeSlot.hour}
        {timeSlot.minute === 0 ? "00" : timeSlot.minute}
    </button>
{:else}
    <button
        class={active ? "active " + "timeSlot" : "notActive " + "timeSlot"}
        on:click={() => {
            workingDay.changeTime(v, selectedDay);
        }}
        >{timeSlot.hour === 0 ? "00" : timeSlot.hour}
        {timeSlot.minute === 0 ? "00" : timeSlot.minute}
    </button>
{/if}

<style>
    .timeSlot {
        width: 100px;
        color: white;
    }
    .active {
        background-color: blue;
    }
    .notActive {
        background-color: darkgoldenrod;
    }
</style>
