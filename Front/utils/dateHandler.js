import moment from "moment";

// format the provided date to the given format
export function formatDate(date, format) {
    return moment(date).format(format);
}

// Return the current date in the given type
export function getLocalDate(type = "date") {
    let date = new Date();
    let localDate = new Date(date.getTime() - date.getTimezoneOffset() * 60000);

    if (type == "iso") {
        localDate = localDate.toISOString();
    }

    return localDate;
}

// Convert the given date to the given type
export function toDate(date, type = "date") {
    let newDate = new Date(date);

    if (type == "iso") {
        newDate = newDate.toISOString();
    }

    return newDate;
}