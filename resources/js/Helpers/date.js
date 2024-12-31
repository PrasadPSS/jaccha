export default function convertToShortDateFormat(dateTimeString) {
    // Extract the date part
    const [date] = dateTimeString.split(" ");
    // Split the date into parts
    const [year, month, day] = date.split("-");
    // Return in DD-MM-YY format
    return `${day}-${month}-${year.slice(2)}`;
}
