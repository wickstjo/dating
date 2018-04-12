<?php
	$section = 'courses';
	require_once 'core/header.php';

	if (isset($_GET['course'])) {

		// CHECK IF COURSE EXISTS
      $check = db::instance()->count('SELECT * FROM courses WHERE slug = ?', array($_GET['course']));

      // COURSE EXISTS
		if ($check === 1) {
         $course = new course($_GET['course']);
         $course->submenu();

         // LESSONS
         if (isset($_GET['lessons'])) {
            
            // ALL LESSONS
            if ($_GET['lessons'] == 'all') {

               $count = $course->fetch('lessonCount');
               $lessons = new lessons($course->fetch('lessonCode'));

               if ($count > 0) {

                  // LESSON COUNT RETURNS ATLEAST ONE
                  $lessons->show();

               } else {

                  // LESSON COUNT RETURNS ZERO
                  echo '<div id="error">No lessons have been published yet.</div>';
               }

               // EITHER WAY, RENDER BUTTON FOR PROFESSORS
               if (misc::isProfessor()) {
                  $lessons->button();
               }

            // SINGLE LESSON
            } else {

               // CHECK IF LESSON EXISTS
               $check = db::instance()->count('SELECT * FROM lessons WHERE slug = ?', array($_GET['lessons']));

               if ($check === 1) {

                  // EXISTS
                  $lesson = new lesson($course->fetch('lessonCode'));
                  $lesson->show();

                  // SHOW BUTTON FOR PROFESSORS
                  if (misc::isProfessor()) {
                     $lesson->button();
                  }

                  $comments = new comments($lesson->fetch('commentsCode'));
                  $comments->show();

                  // SHOW BUTTON FOR ATTENDING STUDENTS AND PROFESSORS
                  if (misc::isAttending($course->fetch('attendingCode')) || misc::isProfessor()) {
                     $comments->button();
                  }

               } else {

                  // DOES NOT EXIST
                  echo '<div id="error">Lesson was not found.</div>';
               }
            }

         // ASSIGNMENTS
         } else if (isset($_GET['assignments'])) {

            // ALL ASSIGNMENTS
            if ($_GET['assignments'] == 'all') {

               $count = $course->fetch('assignmentCount');
               $assignments = new assignments($course->fetch('assignmentCode'));

               if ($count > 0) {

                  // ASSIGNMENT COUNT RETURNS ATLEAST ONE
                  $assignments->show();

               } else {

                  // ASSIGNMENT COUNT RETURNS ZERO
                  echo '<div id="error">No assignments have been published yet.</div>';
               }

               // EITHER WAY, RENDER BUTTON
               if (misc::isProfessor()) {
                  $assignments->button();
               }

            // SINGLE ASSIGNMENT
            } else {

               // CHECK IF ASSIGNMENT EXISTS
               $check = db::instance()->count('SELECT * FROM assignments WHERE slug = ?', array($_GET['assignments']));

               if ($check === 1) {

                  // EXISTS
                  $assignment = new assignment($course->fetch('assignmentCode'));

                  if (isset($_GET['submit'])) {

                     // ALL STUDENT SUBMISSIONS
                     if ($_GET['submit'] == 'all') {

                        // CHECK IF STATUS IS PROFESSOR
                        if (misc::isProfessor()) {

                           // SUCCESS, OVERVIEW VISIBLE FOR PROFESSOR
                           $assignment->show();

                           $submissions = new submissions($assignment->fetch('submissionCode'));
                           $submissions->show();

                        } else {

                           // FAILURE
                           echo '<div id="error">You do not have permission view this material.</div>';
                        }

                     // SINGLE SUBMISSION
                     } else {

                        // CHECK IF QUERY STUDENT IS ATTENDING COURSE
                        if (db::instance()->count('SELECT * FROM attending WHERE code = ? AND username = ?', array($course->fetch('attendingCode'), $_GET['submit'])) == 1) {

                           // SUCCESS & SESSION AND SUBMIT QUERY MATCH OR STATUS IS PROFESSOR
                           if (isset($_SESSION['auth']) && $_SESSION['auth']->fetch('username') == $_GET['submit'] || misc::isProfessor()) {

                              $assignment->show();

                              $submission = new submission($assignment->fetch('submissionCode'), $_GET['submit']);
                              $submission->status();

                              if ($submission->fetch('count') != 0) {

                                 // IF STUDENT HAS SUBMITTED SOMETHING
                                 //$submission->changelog();
                                 $submission->show();
                                 $submission->button(1);

                                 $comments = new comments($submission->fetch('commentsCode'));
                                 $comments->show();
                                 $comments->button();

                              } else {

                                 if (misc::isProfessor()) {
                                    $txt = 'Student has not submitted anything yet.';
                                 } else {
                                    $txt = 'You have not submitted anything yet.';
                                 }

                                 echo '<div id="error">' . $txt . '</div>';
                                 $submission->button(0);
                              }

                           } else {

                              // IF SESSION AND SUBMIT QUERY DOES NOT MATCH
                              echo '<div id="error">You do not have permission to view this material.</div>';
                           }

                        } else {

                           // FAILURE
                           echo '<div id="error">Student is not attending this course.</div>';

                        }
                     }

                  } else {

                     $assignment->show();
                     $assignment->details();

                     // SHOW BUTTON FOR PROFESSORS AND ATTENDING STUDENTS
                     if (misc::isAttending($course->fetch('attendingCode')) || misc::isProfessor()) {
                        $assignment->button();
                     }

                     $comments = new comments($assignment->fetch('commentsCode'));
                     $comments->show();

                     // SHOW BUTTON FOR PROFESSORS AND ATTENDING STUDENTS
                     if (misc::isAttending($course->fetch('attendingCode')) || misc::isProfessor()) {
                        $comments->button();
                     }

                  }

               } else {

                  // DOES NOT EXIST
                  echo '<div id="error">Assignment was not found.</div>';
               }
            }

         // ATTENDING
         } else if (isset($_GET['attending']) && $_GET['attending'] == 'all') {

            $count = $course->fetch('attendingCount');
            $attending = new attending($course->fetch('attendingCode'));

            if ($count > 0) {

               // ATTENDING COUNT RETURNS ATLEAST ONE
               $attending->show();

            } else {

               // ATTENDING COUNT RETURNS ZERO
               echo '<div id="error">No-one has signed up for this course yet.</div>';
            }

            // EITHER WAY, RENDER BUTTON
            if (misc::isStudent()) {
               $attending->button();
            }

         // SINGLE COURSE
         } else {
            $course->show();
            $course->details();
         }

      // COURSE DOES NOT EXIST
		} else {

			// ERROR WHEN QUERY RETURNS 0
			echo '<div id="error">Course does not exist.</div>';
		}

   // ALL COURSES
	} else {
      $courses = new courses();
      $courses->show();

      // RENDER BUTTON FOR PROFESSORS
      if (misc::isProfessor()) {
         $courses->button();
      }
	}

	require_once 'core/footer.php';
?>