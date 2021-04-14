<script>
  import timeline from "../FunctionalComponents/timeline-store";
  import workingDay from "../FunctionalComponents/working-day-store";
  export let day;
  export let action;

  let active = true;
  let buttonClass = "notActiveDay";
  let buttonActive = false;
  let workDays;

  const unsubscribeTimeline = timeline.subscribe((days) => {
    workDays = days;
  });
  const unsubscribeWorkingDay = workingDay.subscribe(() => {});

  $: active = workDays.filter(
    (date) =>
      date[0].month === day.toObject().month &&
      date[0].day === day.toObject().day
  );

  $: if (active.length !== 0) {
    buttonClass = "activeDay";
    buttonActive = false;
  }
  $: if (active.length === 0) {
    buttonClass = "notActiveDay";
    buttonActive = false;
    if (action === "Selecting Time") {
      buttonActive = true;
      buttonClass = "disable";
    }
  }
</script>

{#if action === "Selecting Day"}
  <button
    class={buttonClass + " " + "weekday"}
    disabled={buttonActive}
    variant="outlined"
    on:click={() => timeline.dayPicker(day, workDays)}
    >{day.day}
  </button>
{/if}

{#if action === "Selecting Time"}
  <button
    class={buttonClass + " " + "weekday"}
    disabled={buttonActive}
    variant="outlined"
    on:click={() => workingDay.setNewDay(day, workDays)}
    >{day.day}
  </button>
{/if}

<style>
  .weekday {
    width: 70px;
    font-size: smaller;
    float: left;
    text-align: center;
  }
  .calendar {
    max-width: 540px;
    display: flex;
    flex-wrap: wrap;
    margin: 0 auto;
  }
  button {
    width: 100px;
    color: aliceblue;
  }
  .activeDay {
    background-color: blue;
  }
  .notActiveDay {
    background-color: darkgoldenrod;
  }
  .disable {
    background-color: grey;
  }
</style>
