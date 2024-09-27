import React from 'react';
import {useNavigate} from "react-router-dom";
import WorkoutDTO from "../../dtos/WorkoutDTO.tsx";
import {useState} from "react";
import WorkoutAPI from "../../api/WorkoutApi.tsx";
import websiteRoutes from "../../config/routes/website-routes.tsx";
import SaveForm from "../common/form/SaveForm.tsx";

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

    const handleSubmit = async () => {
        try {
            await WorkoutAPI.updateWorkout(workout.id, workoutUpdated);
            navigate(websiteRoutes.workout.details(workout.id));
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <SaveForm submitFunction={handleSubmit}>
            <div>
                <label>Name</label>
                <input type={"text"} name={"name"} value={workoutUpdated.name} onChange={handleInputChange} required={true}/>
            </div>
            <div>
                <label>Visibility</label>
                <input type={"visibility"} name={"visibility"} value={workoutUpdated.visibility} onChange={handleInputChange} required={true}/>
            </div>
        </SaveForm>
    )
}

export default WorkoutEditForm;