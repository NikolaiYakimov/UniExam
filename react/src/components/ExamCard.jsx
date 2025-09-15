import React from 'react';

const ExamCard = ({ exam, onEdit }) => {
    const isEditable = () => {
        const examDate = new Date(exam.start_time);
        const now = new Date();
        const hoursDifference = (examDate - now) / (1000 * 60 * 60);
        return hoursDifference >= 48;
    };

    const canEdit = isEditable();

    return (
        <div className="flex flex-col bg-white border border-gray-100 rounded-xl p-6 hover:shadow-md transition-all hover:border-primary-100 hover:translate-y-[-2px]">
            <div className="flex justify-between items-start gap-2 mb-3">
                <h2 className="text-lg font-semibold text-gray-900">
                    {exam.subject.subject_name}
                    <span className="block text-sm font-normal text-gray-500 mt-1">
            {exam.subject.description}
          </span>
                </h2>
                <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
          {exam.exam_type}
        </span>
            </div>

            <div className="space-y-3 mb-5">
                <div className="flex items-center gap-2 text-gray-600">
                    <i className="fas fa-calendar-alt w-5 text-gray-400"></i>
                    <span>Дата: <span className="font-medium text-gray-800">
            {new Date(exam.start_time).toLocaleDateString('bg-BG')}
          </span></span>
                </div>
                <div className="flex items-center gap-2 text-gray-600">
                    <i className="fas fa-clock w-5 text-gray-400"></i>
                    <span>Час: <span className="font-medium text-gray-800">
            {new Date(exam.start_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })} -
                        {new Date(exam.end_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
          </span></span>
                </div>
                <div className="flex items-center gap-2 text-gray-600">
                    <i className="fas fa-university w-5 text-gray-400"></i>
                    <span>Зала: <span className="font-medium text-gray-800">{exam.hall.name}</span></span>
                </div>
                <div className="flex items-center gap-2 text-gray-600">
                    <i className="fas fa-users w-5 text-gray-400"></i>
                    <span className={`font-medium ${exam.remaining_slots > 0 ? 'text-green-700' : 'text-red-700'}`}>
            {exam.remaining_slots}/{exam.max_students} места
          </span>
                </div>
            </div>

            <button
                onClick={() => onEdit(exam.id)}
                disabled={!canEdit}
                className={`mt-auto edit-exam-btn w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 ${
                    canEdit
                        ? 'bg-blue-600 hover:bg-blue-700'
                        : 'bg-gray-300 cursor-not-allowed'
                }`}
                data-exam-date={exam.start_time}
            >
                <i className="fa-solid fa-file-pen"></i> Редактирай изпит
            </button>
        </div>
    );
};

export default ExamCard;
