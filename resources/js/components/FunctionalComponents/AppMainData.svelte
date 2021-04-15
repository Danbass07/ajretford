<script>
    import Calendar from "../UIComponents/Calendar/Calendar.svelte";
    import { Button } from "sveltestrap";
    import { fly, fade, slide } from "svelte/transition";
    let user;
    let action;
</script>

<main>
    <div class="top_bar" transition:fade>
        <Button
            color={user === "user" ? "success" : "primary"}
            on:click={() => {
                user = "user";
            }}>taxi</Button
        >
        <Button
            color={user === "vip" ? "success" : "primary"}
            on:click={() => {
                user = "vip";
            }}>VIP</Button
        >
        <Button
            color={user === "customer" ? "success" : "primary"}
            on:click={() => {
                user = "customer";
            }}>Customer</Button
        >
    </div>
    {#if user === "user"}
        <div transition:fade>
            <Button
                color={action === "setWorkingDays" ? "success" : "primary"}
                on:click={() => {
                    action = "setWorkingDays";
                }}>Edit your calendar</Button
            >
            <Button
                color={action === "acceptJobs" ? "success" : "primary"}
                on:click={() => {
                    action = "acceptJobs";
                }}>Avaiable Offers</Button
            >
            <Button
                color={action === "bookings" ? "success" : "primary"}
                on:click={() => {
                    action = "bookings";
                }}>Your Booking</Button
            >
            <Button
                color={action === "history" ? "success" : "primary"}
                on:click={() => {
                    action = "history";
                }}>Completed Bookings</Button
            >
        </div>
        {#if action === "setWorkingDays"}
            <div transition:fade>
                <Calendar />
            </div>
        {/if}

        {#if action === "acceptJobs"}
            <div transition:fade>
                <h1>Avaiable Offers</h1>
            </div>
        {/if}

        {#if action === "bookings"}
            <div transition:fade>
                <h1>Your Bookings</h1>
            </div>
        {/if}

        {#if action === "history"}
            <div transition:fade>
                <h1>Completed Bookings</h1>
            </div>
        {/if}
    {/if}
</main>

<style>
    .top_bar {
        width: 600px;
        border: 1px solid white;
    }
</style>
