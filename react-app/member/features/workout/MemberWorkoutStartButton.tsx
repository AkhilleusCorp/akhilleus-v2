import React from "react";
import {Button} from "@mui/material";


type WorkoutStartButtonType = {
    workoutId: number
}
const MemberWorkoutStartButton: React.FC<WorkoutStartButtonType> = ({ workoutId }) => {

    const onClickStart  = () => {
        console.log(workoutId);
    }

    return (
        <Button variant="contained" color="success" onClick={onClickStart}>Start</Button>
    );
}

export default MemberWorkoutStartButton;