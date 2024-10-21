import React, {useState} from 'react';
import {useNavigate} from "react-router-dom";
import {TextField} from "@mui/material";
import WorkoutApiGateway from "app/admin/services/api/gateway/WorkoutApiGateway.tsx";
import adminRoutes from "app/admin/services/router/adminRoutes.tsx";
import SaveForm from "app/common/components/form/SaveForm.tsx";

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
            const workout = await WorkoutApiGateway.createWorkout(workoutCreate);
            navigate(adminRoutes.workout.details(workout.id));
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <SaveForm submitFunction={handleSubmit}>
            <div>
                <TextField id="outlined-basic" label="Name" variant="outlined" size="small"
                           name={"name"} required={true} onChange={handleInputChange} />
            </div>
        </SaveForm>
    )
}

export default WorkoutCreateForm;