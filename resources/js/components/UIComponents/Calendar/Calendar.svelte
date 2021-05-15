<script>
    import { DateTime, Interval } from "luxon";
    import DayPicker from "./DayPicker.svelte";
    import TimePicker from "./TimePicker.svelte";
    import workingDay from "../../FunctionalComponents/working-day-store";
    import { Button, Icon, Card, CardBody, CardHeader } from "sveltestrap";
    import { Col, Container, Row } from "sveltestrap";
    import { fly, fade, slide } from "svelte/transition";
    import { createEventDispatcher } from "svelte";

    const dispatch = createEventDispatcher();

    export let action;
    export let type;
    export let activeDays;
    export let activeDateHours;
    export let activeDate = [];

    let monthModificator = 0;
    let now = DateTime.local().plus({ month: monthModificator });
    let firstDayOfFirstWeek = now.startOf("month").startOf("week");
    let lastDayOfLasttWeek = now.endOf("month").endOf("week");
    let monthToDisplay = Interval.fromDateTimes(
        firstDayOfFirstWeek,
        lastDayOfLasttWeek
    );
    let minimized = false;
    let monthMatrix = [];

    for (let v = 0; v < monthToDisplay.length("day"); v++) {
        monthMatrix = [...monthMatrix, firstDayOfFirstWeek.plus({ day: v })];
    }

    function actionController() {
        dispatch("action-controller", action);
    }

    function sizeToggle() {
        minimized = !minimized;
    }

    function modificatorController(value) {
        if (minimized) {
            dispatch("change-day", value);
        } else {
            monthModificator = monthModificator + value;
            now = DateTime.local().plus({ month: monthModificator });
        }

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

<svelte:head>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
</svelte:head>

<main>
    <Container class="md" style="min-width:590px; max-width:590px">
        <Card class="mb-3 main-card">
            <CardHeader>
                <Row>
                    <Col>
                        <Button
                            block
                            color="info"
                            on:click={() => modificatorController(-1)}
                        >
                            <Icon name="caret-left-fill" />
                            <Icon name="caret-left-fill" />
                            <Icon name="caret-left-fill" />
                            <Icon name="caret-left-fill" />
                        </Button>
                    </Col>
                    <Col>
                        <button
                            style="height: 100%; padding-top: 11px; min-width: 190px;
                            text-align: center;"
                            block
                            color="info"
                            on:click={sizeToggle}
                        >
                            <h2>
                                {minimized
                                    ? DateTime.fromObject({
                                          month: activeDate.month,
                                          day: activeDate.day,
                                      }).toLocaleString()
                                    : now.monthLong.toUpperCase()}
                            </h2>
                        </button>
                    </Col>
                    <Col>
                        <Button
                            block
                            color="info"
                            on:click={() => modificatorController(1)}
                        >
                            <Icon name="caret-right-fill" />
                            <Icon name="caret-right-fill" />
                            <Icon name="caret-right-fill" />
                            <Icon name="caret-right-fill" />
                        </Button>
                    </Col>
                </Row>
            </CardHeader>
            {#if !minimized}
                <CardBody>
                    <Row>
                        <div class="text-light weekday">Mon</div>
                        <div class="text-light weekday">Tue</div>
                        <div class="text-light weekday">Wed</div>
                        <div class="text-light weekday">Thu</div>
                        <div class="text-light weekday">Fri</div>
                        <div class="text-light weekday">Sat</div>
                        <div class="text-light weekday">Sun</div>

                        {#each monthMatrix as day, i (day.ts)}
                            <DayPicker
                                on:pick-a-day
                                {activeDays}
                                {day}
                                {action}
                                {type}
                            />
                        {/each}
                    </Row>
                </CardBody>
                <Button
                    block
                    color={action === "Selecting Time" ? "light" : "dark"}
                    on:click={actionController}
                    name={action}>{action}</Button
                >
            {/if}
        </Card>

        {#if activeDate.length !== 0}
            <h2>
                {DateTime.fromObject({
                    month: activeDate.month,
                    day: activeDate.day,
                }).toLocaleString(DateTime.DATE_FULL)}
            </h2>
            <Row cols={4}>
                {#each activeDateHours as timeSlot, timeSlotindex ("timeSlot" + timeSlotindex)}
                    <div transition:fade>
                        <TimePicker
                            on:pick-a-time
                            on:pick-a-hour
                            {timeSlot}
                            {timeSlotindex}
                        />
                    </div>
                {/each}
            </Row>
            <Button block on:click={() => workingDay.reverse(activeDateHours)}
                >Reverse</Button
            >
        {/if}
    </Container>
</main>

<style>
    main {
        margin: 0 auto;
        min-width: 620px;
    }

    .weekday {
        width: 78px;
        font-size: 1.2rem;
        float: left;
        text-align: center;
        margin: 5px 0px;
    }

    /* @media (min-width: 640px) {
        main {
            display: flex;
            flex-wrap: wrap;
        }
    } */
</style>
