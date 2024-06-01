let interval;
let startTime;
let count = 0;

function startMeter() {
    const selectedOption = document.getElementById("optionSelect").value;
    clearInterval(interval);
    if (selectedOption === "time") {
        startTime = Date.now();
        interval = setInterval(updateTimeMeter, 1000);
        document.getElementById("timeContainer").classList.remove("d-none");
        document.getElementById("countContainer").classList.add("d-none");
        document.getElementById("stopButton").classList.remove("d-none");
    } else if (selectedOption === "count") {
        count = 0;
        interval = setInterval(updateCountMeter, 1000);
        document.getElementById("countContainer").classList.remove("d-none");
        document.getElementById("timeContainer").classList.add("d-none");
        document.getElementById("stopButton").classList.remove("d-none");
    } else {
        clearInterval(interval);
        document.getElementById("timeContainer").classList.add("d-none");
        document.getElementById("countContainer").classList.add("d-none");
        document.getElementById("stopButton").classList.add("d-none");
    }
}

function stopMeter() {
    clearInterval(interval);
    const selectedOption = document.getElementById("optionSelect").value;
    const displayedData = selectedOption === "time" ? document.getElementById("timeDisplay").textContent : document.getElementById("countDisplay").textContent;
    document.getElementById(selectedOption + "DisplayValue").value = displayedData;
    document.getElementById("stopButton").classList.add("d-none");
}

function updateTimeMeter() {
    const elapsedTime = formatElapsedTime(Date.now() - startTime);
    document.getElementById("timeDisplay").textContent = elapsedTime;
}

function updateCountMeter() {
    count++;
    document.getElementById("countDisplay").textContent = count;
}

function formatElapsedTime(time) {
    const hours = Math.floor(time / (1000 * 60 * 60));
    const minutes = Math.floor((time % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((time % (1000 * 60)) / 1000);
    return (
        padZero(hours) + ":" + padZero(minutes) + ":" + padZero(seconds) + " SEC"
    );
}

function padZero(num) {
    return (num < 10 ? "0" : "") + num;
}

function submitForm() {
    document.getElementById("myForm").action = "code.php";
    document.getElementById("myForm").method = "post";
    document.getElementById("myForm").submit();
}