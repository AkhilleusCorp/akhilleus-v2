import React from 'react';
import {useNavigate} from "react-router-dom";
import {useState} from "react";
import websiteRoutes from "../../services/router/websiteRoutes.tsx";
import SaveForm from "../../components/form/SaveForm.tsx";
import MuscleApiGateway from "../../services/api/gateway/MuscleApiGateway.tsx";
import MuscleDTO from "../../services/api/dtos/MuscleDTO.tsx";
import {FormControl, Grid2 as Grid, SelectChangeEvent, TextField} from "@mui/material";
import SelectInput from "../../components/input/SelectInput.tsx";
import muscleRegistries from "../../constants/muscleRegistries.tsx";

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