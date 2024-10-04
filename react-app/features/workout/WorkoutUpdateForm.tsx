import React from 'react';
import {useNavigate} from "react-router-dom";
import {useState} from "react";
import websiteRoutes from "../../setup/router/websiteRoutes.tsx";
import SaveForm from "../../components/form/SaveForm.tsx";
import WorkoutApiGateway from "../../services/api/gateway/WorkoutApiGateway.tsx";
import WorkoutDTO from "../../services/api/dtos/WorkoutDTO.tsx";
import {SelectChangeEvent, TextField} from "@mui/material";
import DropdownInput from "../../components/input/DropdownInput.tsx";
import workoutRegistries from "../../constants/workoutRegistries.tsx";

type WorkoutEditFormType = {
    workout: WorkoutDTO,
}

const WorkoutEditForm: React.FC<WorkoutEditFormType> = ({workout}) => {
    const navigate = useNavigate();
    const [workoutUpdated, setWorkoutUpdated] = useState<WorkoutDTO>(workout);

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        setWorkoutUpdated({
            ...workoutUpdated,
            [event.target.name]: event.target.value
        });
    }

    const handleSelectChange = (event: SelectChangeEvent) => {
        setWorkoutUpdated({
            ...workoutUpdated,
            [event.target.name]: event.target.value
        });
    }

    const handleSubmit = async () => {
        try {
            await WorkoutApiGateway.updateWorkout(workout.id, workoutUpdated);
            navigate(websiteRoutes.workout.details(workout.id));
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <SaveForm submitFunction={handleSubmit}>
            <div>
                <TextField id="outlined-basic" label="Name" variant="outlined" size="small" required={true}
                           name={"name"} value={workoutUpdated.name} onChange={handleInputChange} />
            </div>
            <div>
                <DropdownInput label={"Status"} name={"visibility"} value={workoutUpdated.visibility} options={workoutRegistries.visibility}
                           onSelectChange={handleSelectChange} required={true} />
            </div>
        </SaveForm>
    )
}

export default WorkoutEditForm;