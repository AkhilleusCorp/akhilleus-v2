import React from 'react';
import {useNavigate} from "react-router-dom";
import {useState} from "react";
import {SelectChangeEvent, TextField} from "@mui/material";
import WorkoutDTO from "app/admin/services/api/dtos/WorkoutDTO.tsx";
import WorkoutApiGateway from "app/admin/services/api/gateway/WorkoutApiGateway.tsx";
import websiteRoutes from "app/admin/services/router/websiteRoutes.tsx";
import SaveForm from "app/common/components/form/SaveForm.tsx";
import SelectInput from "app/common/components/input/SelectInput.tsx";
import workoutRegistries from "app/common/constants/workoutRegistries.tsx";

type WorkoutEditFormType = {
    workout: WorkoutDTO,
}

const WorkoutUpdateForm: React.FC<WorkoutEditFormType> = ({workout}) => {
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
                <SelectInput label={"Status"} name={"visibility"} value={workoutUpdated.visibility} options={workoutRegistries.visibility}
                             onSelectChange={handleSelectChange} required={true} />
            </div>
        </SaveForm>
    )
}

export default WorkoutUpdateForm;