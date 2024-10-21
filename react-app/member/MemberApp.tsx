import * as ReactDOM from "react-dom/client";
import {StrictMode} from "react";
import MemberRouter from "app/member/services/router/MemberRouter.tsx";

const root = document.getElementById("root")!;
ReactDOM.createRoot(root).render(
    <StrictMode>
        <MemberRouter/>
    </StrictMode>
);
