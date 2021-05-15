<script>
    import { Button } from "sveltestrap";
    import { createEventDispatcher } from "svelte";

    export let timeSlot;
    export let timeSlotindex;

    const dispatch = createEventDispatcher();

    let active;

    $: active = timeSlot.avaiable;

    function pickAtime() {
        dispatch("pick-a-time", {
            timeSlotindex: timeSlotindex,
        });
    }

    function pickAhour() {
        dispatch("pick-a-hour", {
            timeSlotindex: timeSlotindex,
        });
    }
</script>

{#if timeSlot.minute === 0}
    <Button
        size="sm"
        style="width: 100px"
        color={active ? "warning" : "secondary"}
        on:click={pickAhour}
        >{timeSlot.hour === 0 ? "00" : timeSlot.hour}
        {timeSlot.minute === 0 ? "00" : timeSlot.minute}
    </Button>
{:else}
    <Button
        size="sm"
        style="width: 100px"
        color={active ? "warning" : "secondary"}
        on:click={pickAtime}
        >{timeSlot.hour === 0 ? "00" : timeSlot.hour}
        {timeSlot.minute === 0 ? "00" : timeSlot.minute}
    </Button>
{/if}

<style>
</style>
