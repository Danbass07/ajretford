<script>
    import workingDay from "../../FunctionalComponents/working-day-store";
    import { Button } from "sveltestrap";

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
    <Button
        size="sm"
        style="width: 100px"
        color={active ? "warning" : "secondary"}
        on:click={() => {
            workingDay.changeTimeHour(v, selectedDay);
        }}
        >{timeSlot.hour === 0 ? "00" : timeSlot.hour}
        {timeSlot.minute === 0 ? "00" : timeSlot.minute}
    </Button>
{:else}
    <Button
        size="sm"
        style="width: 100px"
        color={active ? "warning" : "secondary"}
        on:click={() => {
            workingDay.changeTime(v, selectedDay);
        }}
        >{timeSlot.hour === 0 ? "00" : timeSlot.hour}
        {timeSlot.minute === 0 ? "00" : timeSlot.minute}
    </Button>
{/if}

<style>
</style>
