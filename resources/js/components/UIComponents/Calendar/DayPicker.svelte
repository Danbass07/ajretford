<script>
    import { Button } from "sveltestrap";
    import { createEventDispatcher } from "svelte";

    export let day;
    export let action;
    export let activeDays;

    const dispatch = createEventDispatcher();

    let active = true;
    let buttonClass = "notActiveDay";
    let buttonActive = false;

    $: active = activeDays.filter(
        (date) =>
            date[0].month === day.toObject().month &&
            date[0].day === day.toObject().day
    );

    $: if (active.length !== 0) {
        buttonClass = "warning";
        buttonActive = false;
    }
    $: if (active.length === 0) {
        buttonClass = "secondary";
        buttonActive = false;
        if (action === "Selecting Time") {
            buttonActive = true;
            buttonClass = "disable";
        }
    }
    function pickAday() {
        dispatch("pick-a-day", day);
    }
</script>

<main>
    <Button
        block
        color={buttonClass}
        disabled={buttonActive}
        variant="outlined"
        on:click={pickAday}
        >{day.day}
    </Button>
</main>

<style>
    main {
        width: 78px;
        float: left;
        text-align: center;
    }
</style>
