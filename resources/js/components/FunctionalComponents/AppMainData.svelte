<script>
    import TaxiTimeline from "./TaxiTimeline.svelte";
    import VipPanel from "./VipPanel.svelte";
    import { Button, ButtonGroup } from "sveltestrap";
    import { fly, fade, slide } from "svelte/transition";
    let user;
    let action;
</script>

<main>
    <div class="top_bar" transition:fade>
        <ButtonGroup>
            <Button
                style="width:150px"
                size="lg"
                color={user === "user" ? "success" : "primary"}
                on:click={() => {
                    user = "user";
                }}>TAXI</Button
            >
            <Button
                style="width:150px"
                size="lg"
                color={user === "vip" ? "success" : "primary"}
                on:click={() => {
                    user = "vip";
                }}>VIP</Button
            >
            <Button
                style="width:150px"
                size="lg"
                color={user === "customer" ? "success" : "primary"}
                on:click={() => {
                    user = "customer";
                }}>Customer</Button
            >
        </ButtonGroup>
    </div>
    {#if user === "user"}
        <div class="top_bar" transition:fade>
            <ButtonGroup>
                <Button
                    style="width:150px"
                    color={action === "setWorkingDays" ? "success" : "primary"}
                    on:click={() => {
                        action = "setWorkingDays";
                    }}>Edit Calendar</Button
                >
                <Button
                    style="width:150px"
                    color={action === "acceptJobs" ? "success" : "primary"}
                    on:click={() => {
                        action = "acceptJobs";
                    }}>Avaiable Offers</Button
                >
                <Button
                    style="width:150px"
                    color={action === "bookings" ? "success" : "primary"}
                    on:click={() => {
                        action = "bookings";
                    }}>Your Booking</Button
                >
                <Button
                    style="width:150px"
                    color={action === "history" ? "success" : "primary"}
                    on:click={() => {
                        action = "history";
                    }}>Completed Bookings</Button
                >
            </ButtonGroup>
        </div>

        {#if action === "setWorkingDays"}
            <div transition:fade>
                <TaxiTimeline />
            </div>
        {/if}

        {#if action === "bookings"}
            <div transition:fade />
        {/if}

        {#if action === "history"}
            <div transition:fade />
        {/if}
    {/if}

    {#if user === "vip"}
        <div transition:fade><VipPanel /></div>
    {/if}
</main>

<style>
    .top_bar {
        min-width: 600px;
        margin-bottom: 5px;
    }
    /* .top {
        width: 500px;
    } */
</style>
