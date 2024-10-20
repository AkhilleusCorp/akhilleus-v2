import React, {useState} from 'react';
import {useNavigate} from "react-router-dom";
import {FormControl, Grid2 as Grid, SelectChangeEvent, TextField} from "@mui/material";
import useGetDropdownableEquipments from "app/hooks/equipment/useGetDropdownableEquipments.tsx";
import useGetDropdownableMuscles from "app/hooks/muscle/useGetDropdownableMuscles.tsx";
import QueryIds from "app/utils/interfaces/QueryIds.tsx";
import MovementApiGateway from "app/services/api/gateway/MovementApiGateway.tsx";
import websiteRoutes from "app/services/router/websiteRoutes.tsx";
import movementRegistries from "app/constants/movementRegistries.tsx";
import SaveForm from "app/components/form/SaveForm.tsx";
import SelectInput from "app/components/input/SelectInput.tsx";
import MultiSelectInput from "app/components/input/MultiSelectInput.tsx";

type MovementCreateFormType = {
    name: string;
}

const MovementCreateForm: React.FC = () => {
    const [movementCreate, setMovementCreate] = useState<MovementCreateFormType>({name: ''});
    const equipments = useGetDropdownableEquipments();
    const muscles = useGetDropdownableMuscles();

    const navigate = useNavigate();

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        setMovementCreate({
            ...movementCreate,
            [event.target.name]: event.target.value
        });
    }

    const handleSelectChange = (event: SelectChangeEvent<QueryIds>|SelectChangeEvent) => {
        setMovementCreate({
            ...movementCreate,
            [event.target.name]: event.target.value
        });
    }

    const handleSubmit = async () => {
        try {
            const movement = await MovementApiGateway.createMovement(movementCreate);
            navigate(websiteRoutes.movement.details(movement.id));
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <SaveForm submitFunction={handleSubmit}>
            <Grid size={{ xs: 4 }}>
                <FormControl fullWidth>
                    <TextField id="outlined-basic" label="Name" variant="outlined" size="small"
                               name={"name"} required={true} onChange={handleInputChange}/>
                </FormControl>
                <SelectInput label="Status" name={"status"} value={null}
                             options={movementRegistries.status} required={true} onSelectChange={handleSelectChange}/>
            </Grid>
            <Grid size={{ xs: 4 }}>
                <SelectInput label="Primary muscle" name={"primaryMuscle"} value={null}
                             options={muscles} required={true} onSelectChange={handleSelectChange}/>

                <MultiSelectInput name={"auxiliaryMuscles"} label={"Auxiliary muscles"}
                                  value={[]} required={false} options={muscles} onSelectChange={handleSelectChange}/>

                <MultiSelectInput name={"equipments"} label={"Equipment"}
                                  value={[]} required={false} options={equipments} onSelectChange={handleSelectChange}/>
            </Grid>
        </SaveForm>
    )
}

export default MovementCreateForm;