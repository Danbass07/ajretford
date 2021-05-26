<script>
    import { onDestroy } from "svelte";
    import { DateTime } from "luxon";
    import Calendar from "../UIComponents/Calendar/Calendar.svelte";
    import timeline from "./timeline-store";

    let action = "Order Taxi";

    let workDays;
    let selectedDay = DateTime.local();
    let dayModificator = 0;
$:console.log('test')
    const unsubscribeTimeline = timeline.subscribe((days) => {
        workDays = days;
    });

    onDestroy(() => {
        if (unsubscribeTimeline) {
            unsubscribeTimeline();
        }
    });
    function changeDay(value) {
        console.log(value);
        dayModificator = dayModificator + value.detail;
        selectedDay = DateTime.local().plus({ day: dayModificator });
    }

    function actionController(event) {
        if (event.detail === "Selecting Day") {
            action = "Selecting Time";
        } else {
            action = "Selecting Day";
        }
    }
</script>

<main>
    <Calendar
        activeDays={workDays}
        activeDate={selectedDay}
        activeDateHours={[]}
        on:pick-a-day={(event) => (selectedDay = event.detail)}
        on:pick-a-time={() => console.log("pick day")}
        on:pick-a-hour={() => console.log("pick day")}
        on:action-controller={actionController}
        on:change-day={changeDay}
        {action}
    />
</main>
