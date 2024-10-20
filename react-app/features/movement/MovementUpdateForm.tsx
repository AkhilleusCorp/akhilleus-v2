import React from 'react';
import {useNavigate} from "react-router-dom";
import {useState} from "react";
import {FormControl, Grid2 as Grid, SelectChangeEvent, TextField} from "@mui/material";
import MovementUpdateSource from "app/services/api/source/MovementUpdateSource.tsx";
import useGetDropdownableEquipments from "app/hooks/equipment/useGetDropdownableEquipments.tsx";
import useGetDropdownableMuscles from "app/hooks/muscle/useGetDropdownableMuscles.tsx";
import QueryIds from "app/utils/interfaces/QueryIds.tsx";
import MovementApiGateway from "app/services/api/gateway/MovementApiGateway.tsx";
import websiteRoutes from "app/services/router/websiteRoutes.tsx";
import SaveForm from "app/components/form/SaveForm.tsx";
import SelectInput from "app/components/input/SelectInput.tsx";
import movementRegistries from "app/constants/movementRegistries.tsx";
import MultiSelectInput from "app/components/input/MultiSelectInput.tsx";

type MovementUpdateFormType = {
    movement: MovementUpdateSource,
}

const MovementUpdateForm: React.FC<MovementUpdateFormType> = ({movement}) => {
    const navigate = useNavigate();
    const [movementUpdated, setMovementUpdated] = useState<MovementUpdateSource>(movement);
    const equipments = useGetDropdownableEquipments();
    const muscles = useGetDropdownableMuscles();

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        setMovementUpdated({
            ...movementUpdated,
            [event.target.name]: event.target.value
        });
    }

    const handleSelectChange = (event: SelectChangeEvent<QueryIds>|SelectChangeEvent) => {
        setMovementUpdated({
            ...movementUpdated,
            [event.target.name]: event.target.value
        });
    }

    const handleSubmit = async () => {
        try {
            await MovementApiGateway.updateMovement(movement.id, movementUpdated);
            navigate(websiteRoutes.movement.details(movement.id));
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <SaveForm submitFunction={handleSubmit}>
            <Grid size={{ xs: 4 }}>
                <FormControl fullWidth>
                    <TextField id="outlined-basic" label="Name" variant="outlined" size="small" required={true}
                               name={"name"} value={movementUpdated.name} onChange={handleInputChange}/>
                </FormControl>

                <SelectInput label="Status" name={"status"} value={movementUpdated.status}
                             options={movementRegistries.status} required={true} onSelectChange={handleSelectChange}/>
            </Grid>
            <Grid size={{ xs: 4 }}>
                <SelectInput label="Primary muscle" name={"primaryMuscle"} value={movementUpdated.primaryMuscle}
                             options={muscles} required={true} onSelectChange={handleSelectChange}/>

                <MultiSelectInput name={"auxiliaryMuscles"} label={"Auxiliary muscles"}
                                  value={movementUpdated.auxiliaryMuscles} required={false} options={muscles} onSelectChange={handleSelectChange}/>

                <MultiSelectInput name={"equipments"} label={"Equipment"}
                                  value={movementUpdated.equipments} required={false} options={equipments} onSelectChange={handleSelectChange}/>
            </Grid>
        </SaveForm>
    )
}

export default MovementUpdateForm;