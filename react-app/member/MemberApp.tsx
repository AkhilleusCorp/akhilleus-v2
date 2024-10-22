import * as ReactDOM from "react-dom/client";
import {StrictMode} from "react";
import {Provider} from "react-redux";
import MemberRouter from "app/member/services/router/MemberRouter.tsx";
import {memberStore} from "app/member/services/redux";

const root = document.getElementById("root")!;
ReactDOM.createRoot(root).render(
    <StrictMode>
        <Provider store={memberStore}>
            <MemberRouter/>
        </Provider>
    </StrictMode>
);
