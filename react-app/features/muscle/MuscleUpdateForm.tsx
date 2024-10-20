import React from 'react';
import {useNavigate} from "react-router-dom";
import {useState} from "react";
import {FormControl, Grid2 as Grid, SelectChangeEvent, TextField} from "@mui/material";
import MuscleDTO from "app/services/api/dtos/MuscleDTO.tsx";
import MuscleApiGateway from "app/services/api/gateway/MuscleApiGateway.tsx";
import websiteRoutes from "app/services/router/websiteRoutes.tsx";
import SaveForm from "app/components/form/SaveForm.tsx";
import muscleRegistries from "app/constants/muscleRegistries.tsx";
import SelectInput from "app/components/input/SelectInput.tsx";

type MuscleUpdateFormType = {
    muscle: MuscleDTO,
}

const MuscleUpdateForm: React.FC<MuscleUpdateFormType> = ({muscle}) => {
    const navigate = useNavigate();
    const [muscleUpdated, setMuscleUpdated] = useState<MuscleDTO>(muscle);

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        setMuscleUpdated({
            ...muscleUpdated,
            [event.target.name]: event.target.value
        });
    }

    const handleSelectChange = (event: SelectChangeEvent) => {
        setMuscleUpdated({
            ...muscleUpdated,
            [event.target.name]: event.target.value
        });
    }

    const handleSubmit = async () => {
        try {
            await MuscleApiGateway.updateMuscle(muscle.id, muscleUpdated);
            navigate(websiteRoutes.muscle.details(muscle.id));
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <SaveForm submitFunction={handleSubmit}>
            <Grid size={{ xs: 4 }}>
                <FormControl fullWidth>
                    <TextField id="outlined-basic" label="Name" variant="outlined" size="small" required={true}
                               name={"name"} value={muscleUpdated.name} onChange={handleInputChange}/>
                </FormControl>

                <SelectInput label="Status" name={"status"} value={muscleUpdated.status}
                             options={muscleRegistries.status} required={true} onSelectChange={handleSelectChange}/>
            </Grid>
        </SaveForm>
    )
}

export default MuscleUpdateForm;