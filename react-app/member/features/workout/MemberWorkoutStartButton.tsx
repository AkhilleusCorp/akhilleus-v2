import React from "react";
import {Button} from "@mui/material";
import {useNavigate} from "react-router-dom";
import memberRoutes from "app/member/services/router/memberRoutes.tsx";


type WorkoutStartButtonType = {
    workoutId: number
}
const MemberWorkoutStartButton: React.FC<WorkoutStartButtonType> = ({ workoutId }) => {
    const navigate = useNavigate();

    const onClickStart  = () => {
        navigate(memberRoutes.workout.train(workoutId));
    }

    return (
        <Button variant="contained" color="success" onClick={onClickStart}>Start</Button>
    );
}

export default MemberWorkoutStartButton;