// Object-model syntax
var audioPlayer = {
    audio: null,
    audioReady: false,
    canPlay: false,
    checkLoaded: null,
    currentTrack: -1,
    isPlaying: false,
    maxTracks: null,
    playlist: [
        {
            hostedFile: "<?php echo $musiques['preview']; ?>"
        }
    ],
    repeat: "none",
    repeatIco: {
        none: "lecteur/img/repeat/white/repeat-none.svg",
        one: "lecteur/img/repeat/black/repeat-1.svg",
        all: "lecteur/img/repeat/black/repeat-all.svg"
    },
    tickTen: null,
    volume: 1,
    createAudio: function (hosted, id) {
        // If statement declares if given id is a file name
        // Or a URL
        if (hosted) {
            // Use audio constructor in audio var
            audioPlayer.audio = new Audio(id);
        } else {
            // Use audio constructor in audio var
            audioPlayer.audio = new Audio("audio/" + id);
        }

        // Cannot play; loading
        audioPlayer.canPlay = false;

        // Show loading gif
        $("#loadingDiv").css("display", "block");

        // Audio function for if the file is not returned
        audioPlayer.audio.onerror = function () {
            if (hosted) {
                console.log("Failed to load hosted file. Attempting to load local file.");

                audioPlayer.audio = new Audio("audio/" + audioArray[currentTrack].localFile + ".mp3");

                hosted = 0;

                audioPlayer.audio.onerror = function () {
                    console.log("Failed to load local file. Removing and skipping.");
                    console.log("File failure: " + id);
                    console.log("File failure: " + audioPlayer.playlist[audioPlayer.currentTrack].localFile);

                    audioPlayer.removeFromPlaylist(currentTrack);

                    audioPlayer.checkCurrentTrack();
                };
            } else {
                console.log("Failed to load local file. Attempting to load hosted file.");

                audioPlayer.audio = new Audio(audioPlayer.playlist[audioPlayer.currentTrack].hostedFile);

                hosted = 1;

                audioPlayer.audio.onerror = function () {
                    console.log("Failed to load hosted file. Removing and skipping.");
                    console.log("File failure: " + id);
                    console.log("File failure: " + audioPlayer.playlist[audioPlayer.currentTrack].hostedFile);

                    audioPlayer.removeFromPlaylist(currentTrack);

                    audioPlayer.checkCurrentTrack();
                }
            }
        }

        audioReady = false;

        audioPlayer.audio.canplaythrough = function () {
            audioReady = true;
        }

        audioPlayer.checkLoaded = setInterval(audioPlayer.isLoaded, 100);
    },
    isLoaded: function () {
        if (audioPlayer.audio.readyState == 4 || audioReady) {
            // Play the created audio
            // audioPlayer.play();
            // $("#playButton").addClass("activeControl");
            // $("#pauseButton").removeClass("activeControl");

            // Pause the created audio
            // audioPlayer.pause();
            // $("#playButton").removeClass("activeControl");
            // $("#pauseButton").addClass("activeControl");

            // if(currentTrack>0){
            if (audioPlayer.isPlaying) {
                setTimeout(audioPlayer.play, 500);
            } else {
                setTimeout(audioPlayer.pause, 500);
            }

            // Set the volume of the created audio
            audioPlayer.setVol(audioPlayer.volume);

            // Keep track of the current audio track
            // audioPlayer.currentTrack++

            // Tell everything else that that they can fire
            audioPlayer.canPlay = true;

            // Hide loading gif
            $("#loadingDiv").css("display", "none");

            // Stop looping
            clearInterval(audioPlayer.checkLoaded);

            // Run trackProgress every tenth of a second
            audioPlayer.tickTen = setInterval(audioPlayer.trackProgress, 100);
        }
    },
    play: function () {
        audioPlayer.audio.play();

        // These classes control the background on the play/pause
        // buttons to show which one is active
        $("#playButton").addClass("activeControl");
        $("#pauseButton").removeClass("activeControl");
    },
    pause: function () {
        audioPlayer.audio.pause();

        // These classes control the background on the play/pause
        // buttons to show which one is active
        $("#playButton").removeClass("activeControl");
        $("#pauseButton").addClass("activeControl");
    },
    setVol: function (vol) {
        // If the audio exists
        if (typeof audioPlayer.audio != "undefined") {
            // If the given volume is a number
            if (typeof vol == "number") {
                if (audioPlayer.audio != null) {
                    // If the volume is within the valid range
                    if (vol <= 1 && vol >= 0) {
                        audioPlayer.audio.volume = vol;
                        audioPlayer.volume = vol;
                    }
                }
            }
        }
    },
    skipBackward: function () {
        if (audioPlayer.currentTrack > 0) {
            audioPlayer.audio.pause();

            audioPlayer.currentTrack--;

            audioPlayer.checkCurrentTrack();
        }
    },
    skipForward: function () {
        if (audioPlayer.currentTrack < audioPlayer.maxTracks) {
            audioPlayer.audio.pause();

            audioPlayer.currentTrack++

            audioPlayer.checkCurrentTrack();
        }
    },
    repeatToggle: function () {
        switch ($("#repeatButton").attr("data-repeat")) {
            case "none":
                $("#repeatButton").attr("data-repeat", "single");
                $("#repeatButton img").attr("src", audioPlayer.repeatIco.one);
                audioPlayer.repeat = "single";
                break;
            case "single":
                $("#repeatButton").attr("data-repeat", "all");
                $("#repeatButton img").attr("src", audioPlayer.repeatIco.all);
                audioPlayer.repeat = "all";
                break;
            default:
                $("#repeatButton").attr("data-repeat", "none");
                $("#repeatButton img").attr("src", audioPlayer.repeatIco.none);
                audioPlayer.repeat = "none";
        }
    },
    isValid: function (fileToCheck) {
        // This function checks if the given file is valid or not

        if (fileToCheck != "") {
            var checkEXT = fileToCheck.split(".")

            // Boolean vars to make if statement shorter
            var isMP3 = (checkEXT[checkEXT.length - 1] == "mp3");
            var isM4A = (checkEXT[checkEXT.length - 1] == "m4a");

            // Audio formats
            if (isMP3 || isM4A) {
                return true;
            } else {
                return false;
            }
        }
    },
    checkCurrentTrack: function () {
        // Error prevention
        audioPlayer.maxTracks = (audioPlayer.playlist.length - 1);

        // Set button disabled or not
        if (audioPlayer.currentTrack > 0) {
            $("#backButton").removeClass("disabled");
        } else {
            $("#backButton").addClass("disabled");
        }

        if (audioPlayer.currentTrack < audioPlayer.maxTracks) {
            $("#skipButton").removeClass("disabled");
        } else {
            $("#skipButton").addClass("disabled");
        }

        if (audioPlayer.currentTrack >= audioPlayer.maxTracks && audioPlayer.repeat == "all") {
            audioPlayer.currentTrack = 0;
        }

        audioPlayer.updatePlaylist();

        // Border thickness
        var borderPx = "3px"

        // Add border-left to current track on playlist
        $("[data-item=" + audioPlayer.currentTrack + "]").css("border-left-color", "black");

        // Get the "left" value of the current track's button pos
        var currentLeft = $("[data-item=" + audioPlayer.currentTrack + "] .playlistBtnPos").css("left");

        // New "left" value for current track's button pos is current value - border thickness
        $("[data-item=" + audioPlayer.currentTrack + "] .playlistBtnPos").css("left", (parseInt(currentLeft) - parseInt(borderPx)).toString() + "px");

        // Play the audio based on the current track
        // Error prevention
        if (audioPlayer.isValid(audioPlayer.playlist[audioPlayer.currentTrack].hostedFile)) {
            audioPlayer.createAudio(true, audioPlayer.playlist[audioPlayer.currentTrack].hostedFile);
        }
    },
    trackProgress: function () {
        // Temporary variable, only needed to make sure the lable does not say NaN
        var audioDuration = audioPlayer.audio.duration;

        // If the audioDuration is NaN then set it to 0
        // This prevents the audio player saying "NaN" and appearing broken
        if (audioDuration.toString() == "NaN") {
            audioDuration = 0;
        }

        // Set the audioProg knob's max and value to duration
        // and current time of audio
        $("#audioProg")
            .trigger("configure", {"max": audioDuration})
            .val(audioPlayer.audio.currentTime)
            .trigger("change");

        // Create a temporary variable
        // Initialise variable with a 360deg percentage of
        // the audio's current time verse its duration
        var currentArc = ((audioPlayer.audio.currentTime / audioDuration) * 360) - 5

        // If the arc is less than 0, set it to 0
        if (currentArc < 0) {
            currentArc = 0
        }

        // Set the audioProgStyle knob's arc and max to
        // the currentTime with a delay
        $("#audioProgStyle")
            .trigger(
                "configure",
                {
                    "angleArc": currentArc,
                    "max": (audioPlayer.audio.currentTime)
                }
            )
            .val(audioPlayer.audio.currentTime)
            .trigger("change");

        // Set the label element to show the audio's currentTime
        // $("#audioProgLabel").text(Math.round(audio.currentTime).toString());

        // If the audio is finished
        if (audioPlayer.audio.ended) {
            if (audioPlayer.repeat == "single") {
                audioPlayer.pause();

                audioPlayer.audio.currentTime = 0;

                setTimeout(audioPlayer.play, 1000);
            } else {
                // Stop looping
                clearInterval(audioPlayer.tickTen);

                // New track
                audioPlayer.currentTrack++

                // Check the current track
                audioPlayer.checkCurrentTrack();
            }
        }
    },
    updatePlaylist: function () {
        // If playlist is updated; then playlist must have changed. Update maxTracks var
        audioPlayer.maxTracks = (audioPlayer.playlist.length - 1);

        // Create and declare htmlString as an empty string
        var htmlString = "";

        // For every item in the array
        // Create HTML for the item
        audioPlayer.playlist.forEach(function (currentValue, index) {
            htmlString += "<div class='playlistItem' data-item='" + index + "'>";
            htmlString += "<div class='playlistBtnPos'>";
            htmlString += "<div class='playlistBtn' data-remove='" + index + "'>";
            htmlString += "<i class='fas fa-trash'></i>";
            htmlString += "</div>";
            htmlString += "</div><p>";
            // htmlString += "<strong>localFile:</strong>";
            // htmlString += "<br>"+currentValue.localFile+"<br>";
            htmlString += "<strong>File:</strong>";
            htmlString += "<br>" + currentValue.hostedFile + "";
            htmlString += "</p></div>";
            htmlString += "<hr>";
        });

        // Put the created HTML into the DOM
        $("#playlistView").html(htmlString);

        // This click event is in here instead of down with the others
        // Because the elements it targets are created here
        // And do not exist otherwise
        // Click event for the remove from playlist button
        $(".playlistBtn").click(function () {
            if (audioPlayer.canPlay) {
                // console.log("Click");
                audioPlayer.removeFromPlaylist($(this).attr("data-remove"))
            }
        });
    },
    addToPlaylist: function (newFile) {
        // If the given string is not blank
        if (newFile != "") {
            // Create variable to hold the split string
            var splitInput = newFile.split("");

            // Create variable to hold the first four letters of the split string
            var checkHTTP = "" + splitInput[0] + splitInput[1] + splitInput[2] + splitInput[3];

            // If the first four letters of the string
            // are "http" then it is a hosted file
            if (checkHTTP == "http") {
                if (audioPlayer.isValid(newFile)) {
                    // Push an object to the array containing the file
                    audioPlayer.playlist.push({
                        localFile: "",
                        hostedFile: newFile
                    });
                }
            }
            // else{
            // 	Push an object to the array containing the file
            // 	audioPlayer.playlist.push({
            // 		localFile:newFile,
            // 		hostedFile:""
            // 	});
            // }

            // For debug purposes
            // Allows forcibly loading audio files from any location
            var checkDebug = newFile.split(" ");

            if (checkDebug[0] == "debug") {
                // This will only allow debug commands when loaded from a file
                // NOT on a server
                var splitURL = window.location.href.split("");
                var checkFILE = "" + splitURL[0] + splitURL[1] + splitURL[2] + splitURL[3];

                if (checkFILE == "file") {
                    audioPlayer.playlist.push({
                        localFile: "",
                        hostedFile: checkDebug[1]
                    })
                }
            }

            // Update the DOM to reflect the updated playlist
            audioPlayer.updatePlaylist();

            // Clear the input
            $("#audioInput").val("");
        }
    },
    removeFromPlaylist: function (toRemove) {
        // These variables are for checking if the removal of the track caused
        // the array to change
        if (audioPlayer.currentTrack < (audioPlayer.playlist.length - 1)) {
            // Variable used to check if the file exists
            var checkTrackHosted = audioPlayer.playlist[audioPlayer.currentTrack].hostedFile;

            // Remove the track from the playlist
            audioPlayer.playlist.splice(toRemove, 1);

            // Update the DOM to reflect the updated playlist
            audioPlayer.updatePlaylist();

            // If tree to get the new index of the file
            if (audioPlayer.playlist[audioPlayer.currentTrack].hostedFile != checkTrackHosted) {
                // Incremental var
                var i;

                // For loop checks through audioArray for the file
                for (i = 0; i < audioPlayer.playlist.length; i++) {
                    // If the hostedFile of the current index is the file
                    if (audioPlayer.playlist[i].hostedFile == checkTrackHosted) {
                        // Set the track index to match
                        audioPlayer.currentTrack = i;

                        // Stop looping
                        break
                    } else if (i == (audioPlayer.playlist.length - 1)) {
                        // Else if already checked every item in the array

                        // If the track index is greater than the array's max index
                        if (audioPlayer.currentTrack > (audioPlayer.playlist.length - 1)) {
                            // Set the track index to the array's max index
                            audioPlayer.currentTrack = (audioPlayer.playlist.length - 1);
                        }

                        // Stop the audio
                        audioPlayer.pause();

                        // Switch to the new track
                        audioPlayer.checkCurrentTrack();
                    }
                }
            }
        } else if ((audioPlayer.playlist.length - 1) != 0) {
            // Else if this is not the last item in the array

            // Remove the index from the array
            audioPlayer.playlist.splice(toRemove, 1);

            // Update the DOM playlist
            audioPlayer.updatePlaylist();

            // Set the current track to the array's max index
            audioPlayer.currentTrack = (audioPlayer.playlist.length - 1);

            // Stop the audio
            audioPlayer.pause();

            // Switch to the new track
            audioPlayer.checkCurrentTrack();
        } else {
            // Else

            // Remove the last index from the array
            audioPlayer.playlist.splice(toRemove, 1);

            // Update the DOM playlist
            audioPlayer.updatePlaylist();

            // Stop the audio
            audioPlayer.pause();

            // Set the current track to the array's max index which should be 0
            audioPlayer.currentTrack = (audioPlayer.playlist.length - 1);
        }
    },
    createKnobs: function () {
        // Audio volume knob
        $("#audioVol").knob({
            "angleOffset": -90,
            "angleArc": 180,
            // "displayInput":false,
            "displayPrevious": true,
            "width": "250",
            "min": 0,
            "max": 1,
            "step": 0.01,
            "fgColor":"#5bc0de",
            "draw": function () {
                audioPlayer.setVol(this.v)
            }
        });

        // Audio progress knob
        $("#audioProg").knob({
            "thickness": .2,
            "width": "150",
            "readOnly": true,
            "cursor": "2.5",
            "fgColor":"#5bc0de",
            "draw": function () {
                $(this.i).css("font-size", "1.5em")
            }
        });

        // Audio progress secondary knob
        $("#audioProgStyle").knob({
            "thickness": .2,
            "width": "150",
            "readOnly": true,
            "displayInput": false,
            "angleArc": 0,
            "fgColor": "#f26419",
        });

        audioPlayer.updatePlaylist();

        // Creates the audio after a delay
        // This allows the knobs to initialise beforehand
        setTimeout(function () {
            // New track
            audioPlayer.currentTrack++

            // Locally hosted
            // audioPlayer.createAudio(false,"jackle_app__fortune_cookie")

            // Dropbox hosted
            // audioPlayer.createAudio(true,"https://dl.dropboxusercontent.com/s/roy5ilvpiaoqav3/jackle_app__fortune_cookie.mp3")

            audioPlayer.checkCurrentTrack();
        }, 250)
    }
}

// console.dir(audioPlayer);

$(document).ready(function () {
    // Click event for the play button
    $("#playButton").click(function () {
        if (audioPlayer.canPlay) {
            audioPlayer.play();

            audioPlayer.isPlaying = true;
        }
    });

    // Click event for the pause button
    $("#pauseButton").click(function () {
        if (audioPlayer.canPlay) {
            audioPlayer.pause();

            audioPlayer.isPlaying = false;
        }
    });

    // Click event for the back button
    $("#backButton").click(function () {
        if (audioPlayer.canPlay) {
            audioPlayer.skipBackward();
        }
    });

    // Click event for the forward button
    $("#skipButton").click(function () {
        if (audioPlayer.canPlay) {
            audioPlayer.skipForward();
        }
    });

    // Click event for the add to playlist button
    $("#audioInputBtn").click(function () {
        if (audioPlayer.canPlay) {
            audioPlayer.addToPlaylist($("#audioInput").val());
        }
    });

    // Click event for the repeat button
    $("#repeatButton").click(function () {
        if (audioPlayer.canPlay) {
            audioPlayer.repeatToggle();
        }
    });

    // Call functions
    audioPlayer.createKnobs();
});
