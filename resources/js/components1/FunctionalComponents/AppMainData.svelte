<script>
  import Calendar from "../UIComponents/Calendar.svelte";

  let action = "Selecting Day";

  function actionController(event) {
    if (event.target.name === "Selecting Day") {
      action = "Selecting Time";
    } else {
      action = "Selecting Day";
    }
  }

  function timePickerController(event) {
    if (action === "Selecting Time") {
    }
  }
</script>

<main>
  <button on:click={actionController} name={action}>{action}</button>
  <Calendar {action} />
</main>

<style>
</style>
