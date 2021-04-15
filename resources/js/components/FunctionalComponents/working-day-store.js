import { writable } from "svelte/store";

function workingDay() {
    const selectedDay = writable([]);

    return {
        subscribe: selectedDay.subscribe,
        setNewDay: (day, workDays) => {
            let data = workDays.filter(
                (workDay) =>
                    JSON.stringify(workDay[0]) ===
                    JSON.stringify(day.toObject())
            );
            selectedDay.set(data[0]);
        },
        changeTime: (v, day) => {
            day[1].map((timeSlot, index) => {
                if (index === v) {
                    timeSlot.avaiable = !timeSlot.avaiable;
                }
            });

            selectedDay.update(() => {
                return [...day];
            });
        },
        changeTimeHour: (v, day) => {
            let avaiable = !day[1][v].avaiable;
            day[1].map((timeSlot, index) => {
                if (index >= v && index < v + 4) {
                    timeSlot.avaiable = avaiable;
                }
            });

            selectedDay.update(() => {
                return [...day];
            });
        },
        clearWorkingDay: () => {
            selectedDay.set([]);
        },
        reverse: (day) => {
            day[1].map((timeSlot) => {
                timeSlot.avaiable = !timeSlot.avaiable;
            });

            selectedDay.update(() => {
                return [...day];
            });
        },
    };
}
export default workingDay();
