<script>
    import { DateTime, Interval, Duration } from "luxon";
    import DayPicker from "./DayPicker.svelte";
    import TimePicker from "./TimePicker.svelte";
    import workingDay from "../FunctionalComponents/working-day-store";

    export let action;

    let selectedDay;
    let monthModificator = 0;
    let now = DateTime.local().plus({ month: monthModificator });
    let firstDayOfFirstWeek = now.startOf("month").startOf("week");
    let lastDayOfLasttWeek = now.endOf("month").endOf("week");
    let monthToDisplay = Interval.fromDateTimes(
        firstDayOfFirstWeek,
        lastDayOfLasttWeek
    );
    let monthMatrix = [];

    const unsubscribe = workingDay.subscribe((_workingDay) => {
        selectedDay = _workingDay;
    });

    for (let v = 0; v < monthToDisplay.length("day"); v++) {
        monthMatrix = [...monthMatrix, firstDayOfFirstWeek.plus({ day: v })];
    }

    function monthModificatorController(value) {
        monthModificator = monthModificator + value;
        now = DateTime.local().plus({ month: monthModificator });

        firstDayOfFirstWeek = now.startOf("month").startOf("week");
        lastDayOfLasttWeek = now.endOf("month").endOf("week");
        monthToDisplay = Interval.fromDateTimes(
            firstDayOfFirstWeek,
            lastDayOfLasttWeek
        );
        monthMatrix = [];

        for (let v = 0; v < monthToDisplay.length("day"); v++) {
            monthMatrix = [
                ...monthMatrix,
                firstDayOfFirstWeek.plus({ day: v }),
            ];
        }
    }
</script>

<main>
    <button on:click={() => monthModificatorController(-1)}
        >Previous month</button
    >
    <h2>{now.monthLong}</h2>
    <button on:click={() => monthModificatorController(1)}>Next Month</button>

    <div class="calendar">
        <div class="weekday">Monday</div>
        <div class="weekday">Tuesday</div>
        <div class="weekday">Wednesday</div>
        <div class="weekday">Thursday</div>
        <div class="weekday">Friday</div>
        <div class="weekday">Saturday</div>
        <div class="weekday">Sunday</div>
        {#each monthMatrix as day, i (day.ts)}
            <DayPicker {day} {action} />
        {/each}
        <div class="timeMatrix">
            {#each selectedDay[1] as timeSlot, v ("timeSlot" + v)}
                <TimePicker on:pick-a-time {timeSlot} {v} />
            {/each}
            <button on:click={() => workingDay.reverse(selectedDay)}
                >Reverse</button
            >
        </div>
    </div>
</main>

<style>
    h2 {
        width: 200px;
    }
    .calendar {
        max-width: 540px;
        display: flex;
        flex-wrap: wrap;
        margin: 0 auto;
    }
    .weekday {
        width: 70px;
        font-size: smaller;
        float: left;
        text-align: center;
    }
    main {
        text-align: center;
        padding: 1em;
        max-width: 90%;
        margin: 0 auto;
    }
    .timeMatrix {
        margin: auto auto;
        width: 400px;
    }

    @media (min-width: 640px) {
        main {
            display: flex;
            flex-wrap: wrap;
        }
    }
</style>
