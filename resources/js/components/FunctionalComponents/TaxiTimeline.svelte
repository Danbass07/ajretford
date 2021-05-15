<script>
    import { onDestroy } from "svelte";

    import Calendar from "../UIComponents/Calendar/Calendar.svelte";
    import timeline from "./timeline-store";
    import workingDay from "./working-day-store";

    let action = "Selecting Day";

    let workDays;
    let selectedDay;

    const unsubscribeTimeline = timeline.subscribe((days) => {
        workDays = days;
    });
    const unsubscribe = workingDay.subscribe((_workingDay) => {
        selectedDay = _workingDay;
    });
    onDestroy(() => {
        if (unsubscribeTimeline) {
            unsubscribeTimeline();
            unsubscribe();
        }
    });
    function timelineDayPicker(event) {
        if (action === "Selecting Day") {
            timeline.dayPicker(event.detail, workDays);
        } else {
            workingDay.setNewDay(event.detail, workDays);
        }
    }
    function actionController(event) {
        if (event.detail === "Selecting Day") {
            action = "Selecting Time";
        } else {
            action = "Selecting Day";
            workingDay.clearWorkingDay();
        }
    }
</script>

<main>
    <Calendar
        on:pick-a-day={(event) => timelineDayPicker(event)}
        on:pick-a-time={(event) => {
            workingDay.changeTime(event.detail.timeSlotindex, selectedDay);
        }}
        on:pick-a-hour={(event) => {
            workingDay.changeTimeHour(event.detail.timeSlotindex, selectedDay);
        }}
        on:action-controller={actionController}
        {action}
        activeDays={workDays}
        activeDate={selectedDay[0]}
        activeDateHours={selectedDay[1]}
    />
</main>
