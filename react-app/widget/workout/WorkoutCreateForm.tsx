import React, {useState} from 'react';
import WorkoutAPI from "../../api/WorkoutApi.tsx";
import {useNavigate} from "react-router-dom";
import websiteRoutes from "../../config/routes/website-routes.tsx";
import SaveForm from "../common/form/SaveForm.tsx";

type WorkoutCreateFormType = {
    name: string;
}

const WorkoutCreateForm: React.FC = () => {
    const [workoutCreate, setWorkoutCreate] = useState<WorkoutCreateFormType>({name: ''});
    const navigate = useNavigate();

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        setWorkoutCreate({
            ...workoutCreate,
            [event.target.name]: event.target.value
        });
    }

    const handleSubmit = async () => {
        try {
            const workout = await WorkoutAPI.createWorkout(workoutCreate);
            navigate(websiteRoutes.workout.details(workout.id));
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <SaveForm submitFunction={handleSubmit}>
            <div>
                <label>Name</label>
                <input type={"text"} name={"name"} required={true} onChange={handleInputChange}/>
            </div>
        </SaveForm>
    )
}

export default WorkoutCreateForm;